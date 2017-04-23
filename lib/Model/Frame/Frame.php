<?php

namespace DTL\Phpactor\Model\Frame;

use DTL\Phpactor\Model\Node\Variable;

class Frame
{
    private $variables = [];

    public function set($name, Variable $variable)
    {
        $this->variables[$name] = $variable;
    }

    public function remove($name)
    {
        unset($this->variables[$name]);
    }

    public function all()
    {
        return $this->variables;
    }

    public function keys()
    {
        return array_keys($this->variables);
    }
}
