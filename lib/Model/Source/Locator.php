<?php

namespace DTL\Phpactor\Model\Source;

use DTL\Phpactor\Model\Reflection\FullyQualifiedName;

interface Locator
{
    public function locateForClass(FullyQualifiedName $name);
}
