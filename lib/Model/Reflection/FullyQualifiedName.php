<?php

namespace DTL\Phpactor\Model\Reflection;

class FullyQualifiedName
{
    private $parts;

    public static function fromString(string $string)
    {
        $new = new self();
        $new->parts = explode('\\', trim($string));
        return $new;
    }

    public function getPartsAsStrings(): array
    {
        return $this->parts;
    }

    public function __toString()
    {
        return implode('\\', $this->parts);
    }
}
