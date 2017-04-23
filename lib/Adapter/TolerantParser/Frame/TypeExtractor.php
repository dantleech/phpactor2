<?php

namespace DTL\Phpactor\Adapter\TolerantParser\Frame;

class TypeExtractor
{
    public function getFullyQualifiedType(string $relativeType, Node $node)
    {
        if (NamespaceUtil::isAbsolute($relativeType)) {
            return $relativeType;
        }

        $namespaceNode = $node->getFirstAncestor(NamespaceDefinition::class);
        $useNodes = // ...

        $uses = [];
        foreach ($useNodes as $useNode) {
            if ($useNode->namespaceAliasingClause) {
                $uses[$useNode->namespaceAliasingClause] = $useNode;
            }

            $uses[$useNode->namespaceName->first()] = $useNode;
        }
    }
}
