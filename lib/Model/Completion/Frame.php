<?php

namespace DTL\Phpactor\Model\Completion;

use DTL\Phpactor\Model\Node\Variable;
use DTL\Phpactor\Model\Reflection\Type;

class Frame
{
    private $variableTypeMap = [];

    public function set($name, Type $type)
    {
        $this->variableTypeMap[$name] = $type;
    }

    public function get($name)
    {
        if (!isset($this->variableTypeMap[$name])) {
            throw new \InvalidArgumentException(sprintf(
                'Variable "%s" does not exist, variables existing in this frame: "%s"',
                $name, implode('", "', array_keys($this->variableTypeMap))
            ));
        }

        return $this->variableTypeMap[$name];
    }

    public function remove($name)
    {
        unset($this->variableTypeMap[$name]);
    }

    public function all()
    {
        return $this->variableTypeMap;
    }

    public function keys()
    {
        return array_keys($this->variableTypeMap);
    }
}
