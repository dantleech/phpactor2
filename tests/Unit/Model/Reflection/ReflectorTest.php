<?php

namespace DTL\Phpactor\Tests\Unit\Model\Reflection;

use PHPUnit\Framework\TestCase;
use DTL\Phpactor\Model\Reflection\Reflector;
use DTL\Phpactor\Model\Source\Locator;
use DTL\Phpactor\Model\Source\Source;
use DTL\Phpactor\Model\Reflection\Class_;
use DTL\Phpactor\Model\Reflection\ClassFactory;
use DTL\Phpactor\Model\Reflection\FullyQualifiedName;

class ReflectorTest extends TestCase
{
    private $locator;
    private $factory;
    private $reflector;
    private $classReflection;

    public function setUp()
    {
        $this->locator = $this->prophesize(Locator::class);
        $this->factory = $this->prophesize(ClassFactory::class);
        $this->reflector = new Reflector(
            $this->factory->reveal(),
            $this->locator->reveal()
        );

        $this->classReflection = $this->prophesize(Class_::class);
    }

    /**
     * It reflects a class from a fully qualified name.
     */
    public function testClassReflection()
    {
        $name = FullyQualifiedName::fromString('Fully\\Qualified');
        $source = new Source('hello world');

        $this->locator->locateForClass($name)->willReturn($source);
        $this->factory->reflect($source, $name)->willReturn(
            $this->classReflection->reveal()
        );

        $class = $this->reflector->reflectClass($name);
        $this->assertSame($this->classReflection->reveal(), $class);
    }
}
