<?php

namespace DTL\Phpactor\Model\Source;

interface SourceFile
{
    public function getFile(): \SplFileInfo;
    public function getSource(): Source;
}
