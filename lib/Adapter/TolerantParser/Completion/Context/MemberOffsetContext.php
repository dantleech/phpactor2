<?php

namespace DTL\Phpactor\Adapter\TolerantParser\Completion\Context;

use DTL\Phpactor\Model\Completion\Context\MemberOffsetContext as MemberOffsetContextInterface;
use DTL\Phpactor\Model\Completion\Suggestions;
use Microsoft\PhpParser\Node\Expression\MemberAccessExpression;

class MemberOffsetContext implements MemberOffsetContextInterface
{
    private $node;

    public function __construct(MemberAccessExpression $node)
    {
        $this->node = $node;
    }

    public function getMethodSuggestions(): Suggestions
    {
        $class = $this->resolveClass($node);

        $suggestions = new Suggestions();
        foreach ($class->getMethods() as $method) {
            $suggestions->add(new Suggestion($method->getName()));
        }

        return $suggestions;
    }

    public function getPropertySuggestions(): Suggestions
    {
    }
}
