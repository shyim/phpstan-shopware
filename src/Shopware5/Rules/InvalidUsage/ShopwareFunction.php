<?php

namespace Shyim\PhpStan\Shopware5\Rules\InvalidUsage;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

class ShopwareFunction implements Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\FuncCall::class;
    }

    /**
     * @param Node\Expr\FuncCall $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if ($node->name->toString() !== 'Shopware') {
            return [];
        }

        return [
            'Usage of Shopware() is bad practise. Please use the Dependency Injection and inject the service'
        ];
    }
}