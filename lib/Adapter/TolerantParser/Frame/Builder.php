<?php

namespace DTL\Phpactor\Adapter\TolerantParser\Frame;

use Microsoft\PhpParser\Node\Statement\FunctionDeclaration;
use DTL\Phpactor\Model\Frame\Frame;
use Microsoft\PhpParser\Node;
use Microsoft\PhpParser\Node\Statement\ClassDeclaration;
use Microsoft\PhpParser\Node\Statement\NamespaceDefinition;

class Builder
{
    private $reflector;

    public function buildFrameFor(Node $node)
    {
        $startNode = $node->getFirstAncestor([
            MethodDeclaration::class,
            FunctionDeclaration::class
        ]);

        $frame = new Frame();

        $classNode = $node->getFirstAncestor(ClassDeclaration::class);
        if (null === $classNode) {
            // we do not currently care about non-class situations
            return;
        }

        $this->buildFrame($frame, $node);
    }

    private function buildFrame(Frame $frame, $node)
    {
        // if node is parameter - get type and declare in the frame
        if ($node instanceof Parameter) {
            return $this->resolveParameter($node);
        }

        // if node is variable assign, set variable, type according to value
        //   - if property fetch, type according to property annotation
        //   - if method fetch, type according to method return
    }

    private function resolveParameter(Parameter $parameter)
    {
        $type = $parameter->typeDeclaration->getText();
        $this->getFullyQualifiedType($type, $node);
    }
}
