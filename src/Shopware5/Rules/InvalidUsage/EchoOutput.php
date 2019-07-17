<?php

namespace Shyim\PhpStan\Shopware5\Rules\InvalidUsage;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

class EchoOutput implements Rule
{
    public function getNodeType(): string
    {
        return Node\Stmt\Echo_::class;
    }

    /**
     * @param Node\Stmt\Echo_ $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        return [
            'Echo output should be avoided. Please consider to use $response->setBody'
        ];
    }
}