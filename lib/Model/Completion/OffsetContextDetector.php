<?php

namespace DTL\Phpactor\Model\Completion;

interface OffsetContextDetector
{
    public function detectFor(Request $request): OffsetContext;
}
