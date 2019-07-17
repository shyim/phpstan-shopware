<?php

namespace Shyim\PhpStan\Shopware5\Rules\InvalidUsage;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

class DebugFunction implements Rule
{
    private const DEBUG_FUNCTIONS = [
        'var_dump',
        'print_r',
        'dd',
        'dump',
        'log',
    ];

    public function getNodeType(): string
    {
        return Node\Expr\FuncCall::class;
    }

    /**
     * @param Node\Expr\FuncCall $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!in_array($node->name->toString(), self::DEBUG_FUNCTIONS, true)) {
            return [];
        }

        return [
            sprintf('Code contains a debug statement "%s". Please remove it, before publishing the code', $node->name->toString())
        ];
    }
}