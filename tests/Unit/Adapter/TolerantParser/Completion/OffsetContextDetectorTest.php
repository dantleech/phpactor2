<?php

namespace DTL\Phpactor\Tests\Unit\Adapter\TolerantParser\Completion;

use PHPUnit\Framework\TestCase;
use DTL\Phpactor\Adapter\TolerantParser\Completion\OffsetContextDetector;
use Microsoft\PhpParser\Parser;
use DTL\Phpactor\Model\Source\Source;
use DTL\Phpactor\Model\Source\Offset;
use DTL\Phpactor\Model\Completion\Request;
use DTL\Phpactor\Adapter\TolerantParser\Completion\Context\MemberOffsetContext;
use DTL\Phpactor\Model\Completion\Context\UnknownOffsetContext;
use DTL\Phpactor\Tests\Util\SourceHelper;

class OffsetContextDetectorTest extends TestCase
{
    private $detector;

    public function setUp()
    {
        $this->detector = new OffsetContextDetector(new Parser());
    }

    public function testDetect()
    {
        $request = $this->getRequest('member1');
        $offsetContext = $this->detector->detectFor($request);
        $this->assertInstanceOf(MemberOffsetContext::class, $offsetContext);
    }

    public function testDetectUnknown()
    {
        $request = $this->getRequest('unknown');
        $offsetContext = $this->detector->detectFor($request);
        $this->assertInstanceOf(UnknownOffsetContext::class, $offsetContext);
    }

    private function getRequest($name): Request
    {
        $source = __DIR__ . '/fixtures/' . $name;
        $source = file_get_contents($source);

        return SourceHelper::getRequest($source);
    }
}
