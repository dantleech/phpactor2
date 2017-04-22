<?php

namespace DTL\Phpactor\Model\Completion;

use DTL\Phpactor\Model\Source\Source;
use DTL\Phpactor\Model\Source\Offset;

final class Request
{
    private $offset;
    private $source;

    public function __construct(Source $source, Offset $offset)
    {
        $this->source = $source;
        $this->offset = $offset;
    }
}
