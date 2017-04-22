<?php

namespace DTL\Phpactor\Model\Completion;

final class Providers implements \IteratorAggregate
{
    private $providers = [];

    public static function fromArray(array $providers)
    {
        $new = new self();
        foreach ($providers as $provider) {
            $new->add($provider);
        }

        return $new;
    }

    public function add(Provider $provider)
    {
        $this->providers[] = $provider;
    }

    public function for(OffsetContext $offsetContext): Providers
    {
        $providers = new Providers();
        foreach ($this->providers as $provider) {
            if (false === $provider->canProvideFor($offsetContext)) {
                continue;
            }

            $providers->add($provider);
        }

        return $providers;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->providers);
    }
}
