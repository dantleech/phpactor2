<?php

namespace DTL\Phpactor\Model\Completion;

final class Suggestion
{
    const TYPE_METHOD = 'method';
    const TYPE_PROPERTY = 'property';

    private $suggestion;

    public static function fromName(string $name)
    {
        $new = new self();
        $new->suggestion = $name;

        return $new;
    }

    public function __toString()
    {
        return $this->suggestion;
    }
}
