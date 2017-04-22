<?php

namespace DTL\Phpactor\Model\Completion\Provider;

use DTL\Phpactor\Model\Completion\OffsetContext;
use DTL\Phpactor\Model\Completion\Suggestions;
use DTL\Phpactor\Model\Completion\Context\MemberOffsetContext;

class MemberProvider
{
    public function canProvideFor(OffsetContext $context)
    {
        return $context instanceof MemberOffsetContext;
    }

    public function suggest(OffsetContext $context, Suggestions $suggestions)
    {
        foreach ($context->getPropertySuggestions() as $propertySuggestion) {
            $suggestions->add($propertySuggestion);
        }

        foreach ($context->getMethodSuggestions() as $methodSuggestion) {
            $suggestions->add($methodSuggestion);
        }
    }
}
