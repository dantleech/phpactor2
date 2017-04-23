<?php

namespace DTL\Phpactor\Model\Reflection;

use DTL\Phpactor\Model\Reflection\FullyQualifiedName;

class ClassType implements Type
{
    private $name;

    public function __construct(FullyQualifiedName $name)
    {
        $this->name = $name;
    }

    public static function fromString(string $string)
    {
        return new self(FullyQualifiedName::fromString($string));
    }

    public function getName(): FullyQualifiedName
    {
        return $this->name;
    }
}
