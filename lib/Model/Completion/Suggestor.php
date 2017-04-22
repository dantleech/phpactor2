<?php

namespace DTL\Phpactor\Model\Completion;

class Suggestor
{
    private $contextDetector;
    private $providers;

    public function __construct(OffsetContextDetector $contextDetector, Providers $providers)
    {
        $this->contextDetector = $contextDetector;
        $this->providers = $providers;
    }

    public function suggest(Request $request)
    {
        $offsetContext = $this->contextDetector->detectFor($request);

        $suggestions = new Suggestions();
        foreach ($this->providers->for($offsetContext) as $provider) {
            $provider->suggest($offsetContext, $suggestions);
        }

        return $suggestions;
    }
}
