<?php

namespace DTL\Phpactor\Tests\Unit\Adapter\TolerantParser\Frame;

use PHPUnit\Framework\TestCase;
use Microsoft\PhpParser\Parser;
use DTL\Phpactor\Adapter\TolerantParser\Frame\Builder;
use DTL\Phpactor\Model\Reflection\Reflector;
use Microsoft\PhpParser\Node\StringLiteral;
use DTL\Phpactor\Model\Completion\TypeResolver;
use DTL\Phpactor\Model\Reflection\ScalarType;
use Prophecy\Argument;
use Microsoft\PhpParser\Node;
use Microsoft\PhpParser\Node\Statement\ClassDeclaration;
use DTL\Phpactor\Tests\Util\SourceHelper;

class BuilderTest extends TestCase
{
    private $parser;
    private $builder;
    private $relector;
    private $typeResolver;

    public function setUp()
    {
        $this->parser = new Parser();
        $this->reflector = $this->prophesize(Reflector::class);
        $this->typeResolver = $this->prophesize(TypeResolver::class);

        $this->builder = new Builder($this->reflector->reveal(), $this->typeResolver->reveal());
    }

    public function testAssignment()
    {
        $code = <<<'EOT'
<?php

$a = 'string';
EOT
        ;
        $type = new ScalarType('string');
        $root = $this->parser->parseSourceFile($code);
        $node = $root->getFirstDescendantNode(StringLiteral::class);
        $this->typeResolver->resolveTypeForNode(Argument::type(Node::class))->willReturn($type);
        $frame = $this->builder->buildFrameFor($node);
        $this->assertEquals([
            '$a' => $type
        ], $frame->all());
    }

    public function testAssignmentInMethod()
    {
        $code = <<<'EOT'
<?php

$notMe = 'boo';

class Foobar 
{
    public function foobar()
    {
        $a = 'string';
    }
}
EOT
        ;
        $type = new ScalarType('string');
        $root = $this->parser->parseSourceFile($code);
        $node = $root->getFirstDescendantNode(ClassDeclaration::class)->getFirstDescendantNode(StringLiteral::class);
        $this->typeResolver->resolveTypeForNode(Argument::type(Node::class))->willReturn($type);
        $frame = $this->builder->buildFrameFor($node);
        $this->assertEquals([
            '$a' => $type
        ], $frame->all());
    }

    public function testParameters()
    {
        $code = <<<'EOT'
<?php

class Foobar
{
    public function foobar(string $bar = 'faz', $baz = 'bar')
    {
        __CURSOR__
        'foo';

        $youCantSeeMe = 'no you cannot';
    }
}
EOT
        ;
        $request = SourceHelper::getRequest($code);
        $type = new ScalarType('string');
        $root = $this->parser->parseSourceFile($request->getSource());
        $node = $root->getDescendantNodeAtPosition($request->getOffset()->asInt());

        $this->typeResolver->resolveTypeForNode(Argument::type(Node::class))->willReturn($type);
        $frame = $this->builder->buildFrameFor($node);
        $this->assertEquals([
            '$bar' => $type,
            '$baz' => $type,
        ], $frame->all());

    }
}
