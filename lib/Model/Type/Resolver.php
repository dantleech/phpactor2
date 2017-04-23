<?php

namespace DTL\Phpactor\Model\Type;

class Resolver
{
    public function resolve(SurrogateNode $node)
    {
        if ($node instanceof MethodCall) {
            $baseType = $this->resolve($node);
        }

        if ($node instanceof Variable) {
            return $this->frameProcessor->findTypeFor($node);
        }

        if ($node instanceof MethodCall) {
            $class = $this->reflector->reflectClass($baseType->getClassName());

            return $class->getMethod($node->getName())->getReturnType();
        }
    }
}
