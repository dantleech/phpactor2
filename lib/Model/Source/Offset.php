<?php

namespace DTL\Phpactor\Model\Source;

class Offset
{
    private $offset;

    public function __construct(int $offset)
    {
        $this->offset = $offset;
    }
}
