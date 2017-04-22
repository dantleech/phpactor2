<?php

namespace DTL\Phpactor\Model\Reflection;

class AbsoluteNamespace
{
    private $parts;

    public function fromString(string $string)
    {
        $this->parts = explode('\\', trim($string));
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
