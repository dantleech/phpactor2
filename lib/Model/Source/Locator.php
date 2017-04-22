<?php

namespace DTL\Phpactor\Model\Source;

use DTL\Phpactor\Model\Reflection\AbsoluteNamespace;

interface Locator
{
    public function fromNamespace(AbsoluteNamespace $namespace);
}
