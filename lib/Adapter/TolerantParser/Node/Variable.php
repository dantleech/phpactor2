<?php

namespace DTL\Phpactor\Adapter\TolerantParser\Node;

use Microsoft\PhpParser\Node\Expression\Variable as ParserVariable;
use DTL\Phpactor\Model\Node\Variable as VariableInterface;


class Variable implements VariableInterface
{
    public function __construct(ParserVariable $variable)
    {
        $this->variable = $variable;
    }
}
