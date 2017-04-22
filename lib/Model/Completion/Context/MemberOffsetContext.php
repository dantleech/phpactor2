<?php

namespace DTL\Phpactor\Model\Completion\Context;

use DTL\Phpactor\Model\Completion\OffsetContext;
use DTL\Phpactor\Model\Completion\Suggestions;

interface MemberOffsetContext extends OffsetContext
{
    public function getMethodSuggestions(): Suggestions;

    public function getPropertySuggestions(): Suggestions;
}
