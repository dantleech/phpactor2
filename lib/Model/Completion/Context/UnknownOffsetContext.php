<?php

namespace DTL\Phpactor\Model\Completion\Context;

use DTL\Phpactor\Model\Completion\OffsetContext;
use DTL\Phpactor\Model\Completion\Suggestions;

class UnknownOffsetContext implements OffsetContext
{
    public function getMethodSuggestions(): Suggestions
    {
        return new Suggestions();
    }

    public function getPropertySuggestions(): Suggestions
    {
        return new Suggestions();
    }
}

