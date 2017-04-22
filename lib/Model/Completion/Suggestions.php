<?php

namespace DTL\Phpactor\Model\Completion;

final class Suggestions
{
    private $suggestions = [];

    public function add(Suggestion $suggestion)
    {
        $this->suggestions[] = $suggestion;
    }
}
