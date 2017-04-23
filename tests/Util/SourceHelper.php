<?php

namespace DTL\Phpactor\Tests\Util;

use DTL\Phpactor\Model\Completion\Request;
use DTL\Phpactor\Model\Source\Source;
use DTL\Phpactor\Model\Source\Offset;

class SourceHelper
{
    public static function getRequest(string $source): Request
    {
        $offset = strpos($source, '__CURSOR__');
        $source = str_replace('__CURSOR__', '', $source);

        return new Request(new Source($source), new Offset($offset));
    }
}
