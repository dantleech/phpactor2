<?php

namespace DTL\Phpactor\Tests\Unit\Model\Frame;

use PHPUnit\Framework\TestCase;
use DTL\Phpactor\Model\Reflection\ClassType;
use DTL\Phpactor\Model\Completion\Frame;

class FrameTest extends TestCase
{
    /**
     * It should set variable types.
     */
    public function testFrame()
    {
        $type = ClassType::fromString('foobar');
        $frame = new Frame();
        $frame->set('foo', $type);

        $this->assertEquals($type, $frame->get('foo'));
        $this->assertEquals(['foo'], $frame->keys());
        $frame->remove('foo');
        $this->assertEquals([], $frame->keys());
    }

    /**
     * Throws exception if variable not found in frame.
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Variable "bar" does not exist
     */
    public function testExceptionVariableNotFoundInFrame()
    {
        $type = ClassType::fromString('foobar');
        $frame = new Frame();
        $frame->set('foo', $type);
        $frame->get('bar');
    }
}
