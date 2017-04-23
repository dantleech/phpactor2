<?php

namespace DTL\Phpactor\Model\Reflection;

class PropertyCollection extends AbstractCollection
{
    public function getType()
    {
        return Property::class;
    }
}
