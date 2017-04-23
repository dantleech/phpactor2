<?php

namespace DTL\Phpactor\Model\Reflection;

use DTL\Phpactor\Model\Source\Locator;
use DTL\Phpactor\Model\Reflection\ClassFactory;

class Reflector
{
    private $reflectionFactory;
    private $sourceLocator;

    public function __construct(ClassFactory $reflectionFactory, Locator $sourceLocator)
    {
        $this->reflectionFactory = $reflectionFactory;
        $this->sourceLocator = $sourceLocator;
    }

    public function reflectClass(FullyQualifiedName $name)
    {
        $source = $this->sourceLocator->locateForClass($name);

        return $this->reflectionFactory->reflect($source, $name);
    }
}
