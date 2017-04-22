<?php

namespace DTL\Phpactor\Model\Completion;

use DTL\Phpactor\Model\Completion\OffsetContext;

interface Provider
{
    public function canProvideFor(OffsetContext $request);

    public function suggest(OffsetContext $request);
}
