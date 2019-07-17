<?php

namespace Shyim\PhpStan\Shopware5\Rules\InvalidUsage;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Type\ObjectType;

class ZendDb implements Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\MethodCall::class;
    }

    /**
     * @param Node\Expr\MethodCall $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if ($scope->getType($node)->accepts(new ObjectType('Enlight_Components_Db_Adapter_Pdo_Mysql'), false)->no()) {
            return [];
        }

        return [
            'Usage of Zend_Db is bad practise. Please use DBAL Connection instead'
        ];
    }
}