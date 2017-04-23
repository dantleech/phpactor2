<?php

namespace DTL\Phpactor\Model\Reflection;

use DTL\Phpactor\Model\Source\Source;

interface ClassFactory
{
    public function reflect(Source $source, FullyQualifiedName $name): Class_;
}
