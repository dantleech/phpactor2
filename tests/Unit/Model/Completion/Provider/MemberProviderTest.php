<?php

namespace DTL\Phpactor\Tests\Unit\Model\Completion\Provider;

use PHPUnit\Framework\TestCase;
use DTL\Phpactor\Model\Completion\Provider\MemberProvider;
use DTL\Phpactor\Model\Completion\Context\MemberOffsetContext;
use DTL\Phpactor\Model\Completion\Suggestions;
use DTL\Phpactor\Model\Completion\Suggestion;

class MemberProviderTest extends TestCase
{
    public function setUp()
    {
        $this->provider = new MemberProvider();
        $this->context = $this->prophesize(MemberOffsetContext::class);
    }

    /**
     * It can provide for member offset context
     */
    public function testProvidesFor()
    {
        $this->assertTrue($this->provider->canProvideFor($this->context->reveal()));
    }

    /**
     * It provides methods and property suggestions.
     */
    public function testProvideMethodAndPropertySuggestions()
    {
        $this->context->getPropertySuggestions()->willReturn(Suggestions::fromArray([
            Suggestion::fromName(Suggestion::TYPE_PROPERTY, 'foobar'),
            Suggestion::fromName(Suggestion::TYPE_PROPERTY, 'barfoo')
        ]));
        $this->context->getMethodSuggestions()->willReturn(Suggestions::fromArray([
            Suggestion::fromName(Suggestion::TYPE_METHOD, 'foobar'),
            Suggestion::fromName(Suggestion::TYPE_METHOD, 'barfoo')
        ]));

        $suggestions = new Suggestions();
        $this->provider->suggest($this->context->reveal(), $suggestions);

        $this->assertCount(4, iterator_to_array($suggestions));
    }
}
