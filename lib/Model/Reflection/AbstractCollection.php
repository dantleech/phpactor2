<?php

namespace DTL\Phpactor\Model\Reflection;

abstract class AbstractCollection implements \IteratorAggregate
{
    private $elements;

    public function add($element)
    {
        if (!is_object($element)) {
            throw new \RuntimeException(sprintf(
                'Collections are for objects, got "%s"',
                gettype($element)
            ));
        }

        $type = $this->getType();

        if (!$element instanceof $type) {
            throw new \InvalidArgumentException(sprintf(
                'Element must be of type "%s", got "%s"',
                $type, get_class($element)
            ));
        }

        $this->elements[] = $element;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->elements);
    }

    abstract protected function getType(): string;
}
