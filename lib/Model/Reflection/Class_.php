<?php

namespace DTL\Phpactor\Model\Reflection;

interface Class_
{
    public function getName(): FullyQualifiedName;

    public function getMethods(): MethodCollection;

    public function getProperties(): PropertyCollection;
}
