<?php

namespace DTL\Phpactor\Model\Completion;

final class Suggestion
{
    private $suggestion;

    public function fromString(string $name)
    {
        $this->suggestion = $suggestion;
    }

    public function __toString()
    {
        return $this->suggestion;
    }
}
