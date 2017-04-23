<?php

namespace DTL\Phpactor\Tests\Unit\Model\Completion;

use PHPUnit\Framework\TestCase;
use DTL\Phpactor\Model\Completion\Provider;
use DTL\Phpactor\Model\Completion\Suggestor;
use DTL\Phpactor\Model\Completion\OffsetContextDetector;
use DTL\Phpactor\Model\Completion\Suggestions;
use DTL\Phpactor\Model\Completion\Providers;
use DTL\Phpactor\Model\Completion\Request;
use DTL\Phpactor\Model\Source\Source;
use DTL\Phpactor\Model\Source\Offset;
use Prophecy\Argument;
use DTL\Phpactor\Model\Completion\OffsetContext;

class SuggestorTest extends TestCase
{
    private $suggestor;
    private $provider1;
    private $provider2;
    private $contextDetector;
    private $context1;
    private $context2;

    public function setUp()
    {
        $this->contextDetector = $this->prophesize(ContextDetector::class);

        $this->provider1 = $this->prophesize(Provider::class);
        $this->provider2 = $this->prophesize(Provider::class);
        $this->contextDetector = $this->prophesize(OffsetContextDetector::class);
        $this->context1 = $this->prophesize(OffsetContext::class);
        $this->context2 = $this->prophesize(OffsetContext::class);
    }

    /**
     * It should get suggestions from suggestion providers.
     */
    public function testSuggestionsFromProviders()
    {
        $request = new Request(new Source('foobar'), new Offset(123));

        $this->contextDetector->detectFor($request)->willReturn($this->context1->reveal());
        $this->provider1->canProvideFor($this->context1->reveal())->willReturn(true);
        $this->provider1->suggest($this->context1->reveal(), Argument::type(Suggestions::class))->shouldBeCalled();

        $suggestor = $this->createSuggestor([
            $this->provider1->reveal()
        ]);
        $suggestor->suggest($request);

    }

    private function createSuggestor(array $providers)
    {
        return new Suggestor($this->contextDetector->reveal(), Providers::fromArray($providers));
    }
}
