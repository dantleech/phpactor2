<?php

namespace DTL\Phpactor\Adapter\TolerantParser\Completion;

use DTL\Phpactor\Model\Completion\OffsetContextDetector as OffsetContextDetectorInterface;
use DTL\Phpactor\Model\Completion\OffsetContext;
use DTL\Phpactor\Model\Completion\Request;
use Microsoft\PhpParser\Parser;
use Microsoft\PhpParser\Node\Expression\MemberAccessExpression;
use DTL\Phpactor\Model\Completion\Context\UnknownOffsetContext;
use DTL\Phpactor\Adapter\TolerantParser\Completion\Context\MemberOffsetContext;

class OffsetContextDetector implements OffsetContextDetectorInterface
{
    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function detectFor(Request $request): OffsetContext
    {
        $root = $this->parser->parseSourceFile((string) $request->getSource());
        $node = $root->getDescendantNodeAtPosition($request->getOffset()->asInt());
        $node = $node->getParent();

        if ($node instanceof MemberAccessExpression) {
            return new MemberOffsetContext($node);
        }

        return new UnknownOffsetContext();
    }
}
