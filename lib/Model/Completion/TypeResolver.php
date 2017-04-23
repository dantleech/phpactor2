<?php

namespace DTL\Phpactor\Model\Completion;

interface TypeResolver
{
    public function resolveTypeForNode($node);
}
