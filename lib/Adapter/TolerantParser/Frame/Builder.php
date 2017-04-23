<?php

namespace DTL\Phpactor\Adapter\TolerantParser\Frame;

use Microsoft\PhpParser\Node\Statement\FunctionDeclaration;
use Microsoft\PhpParser\Node;
use Microsoft\PhpParser\Node\Statement\ClassDeclaration;
use Microsoft\PhpParser\Node\Statement\NamespaceDefinition;
use DTL\Phpactor\Model\Reflection\Reflector;
use DTL\Phpactor\Model\Completion\Frame;
use Microsoft\PhpParser\Node\SourceFileNode;
use Microsoft\PhpParser\Node\MethodDeclaration;
use Microsoft\PhpParser\Node\Statement\ExpressionStatement;
use Microsoft\PhpParser\Node\Expression\AssignmentExpression;
use DTL\Phpactor\Model\Completion\TypeResolver;
use Microsoft\PhpParser\Node\Expression\Variable;
use Microsoft\PhpParser\Node\Parameter;

class Builder
{
    private $reflector;
    private $typeResolver;

    public function __construct(Reflector $reflector, TypeResolver $typeResolver)
    {
        $this->reflector = $reflector;
        $this->typeResolver = $typeResolver;
    }

    public function buildFrameFor(Node $node)
    {
        $startNode = $node->getFirstAncestor(
            MethodDeclaration::class,
            FunctionDeclaration::class,
            SourceFileNode::class
        );

        $frame = new Frame();

        $this->buildFrame($frame, $node, $startNode);

        return $frame;
    }

    private function buildFrame(Frame $frame, $targetNode, $node)
    {
        if ($node instanceof AssignmentExpression) {
            $type = $this->typeResolver->resolveTypeForNode($node);
            $variableNames = $this->resolveVariables($node->leftOperand);

            // assign the same type to all variables - this is just a safety
            // measure, it is assumed that we cannot resolve types for lists
            // etc.
            foreach ($variableNames as $variableName) {
                $frame->set($variableName, $type);
            }
        }

        if ($node instanceof Parameter) {
            $type = $this->typeResolver->resolveTypeForNode($node);
            $name = $node->variableName->getText($node->getFileContents());
            $frame->set($name, $type);
        }

        foreach ($node->getChildNodes() as $child) {
            if ($child === $targetNode) {
                return false;
            }

            if (false === $this->buildFrame($frame, $targetNode, $child)) {
                return false;
            }
        }
    }

    private function resolveParameter(Parameter $parameter)
    {
        $type = $parameter->typeDeclaration->getText();
        $this->getFullyQualifiedType($type, $node);
    }

    private function resolveVariables(Node $node)
    {
        if ($node instanceof Variable) {
            return [ $node->getText() ];
        }

        return [];
    }
}
