<?php

namespace DTL\Phpactor\Model\Completion;

final class Suggestions implements \IteratorAggregate
{
    private $suggestions = [];

    public static function fromArray(array $suggestions)
    {
        $new = new self();
        foreach ($suggestions as $suggestion) {
            $new->add($suggestion);
        }

        return $new;
    }

    public function add(Suggestion $suggestion)
    {
        $this->suggestions[] = $suggestion;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->suggestions);
    }
}
