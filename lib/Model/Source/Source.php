<?php

namespace DTL\Phpactor\Model\Source;

class Source
{
    private $source;

    public function __construct(string $source)
    {
        $this->source = $source;
    }

    public function getSource(): string
    {
        return $this->source;
    }
    
}
