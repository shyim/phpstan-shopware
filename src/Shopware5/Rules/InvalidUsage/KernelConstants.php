<?php

namespace Shyim\PhpStan\Shopware5\Rules\InvalidUsage;

use PhpParser\Node;
use PhpParser\Node\Expr\ClassConstFetch;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\ShouldNotHappenException;

class KernelConstants implements Rule
{
    private const DEPRECATED_CONSTS = [
        'VERSION' => 'version',
        'REVISION' => 'revision',
        'VERSION_TEXT' => 'version_text'
    ];

    public function getNodeType(): string
    {
        return ClassConstFetch::class;
    }

    /**
     * @param \PhpParser\Node $node
     * @param \PHPStan\Analyser\Scope $scope
     * @return (string|RuleError)[] errors
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node instanceof ClassConstFetch) {
            throw new ShouldNotHappenException();
        }

        if (! $node->class instanceof Node\Name\FullyQualified) {
            return [];
        }

        if ($node->class->toString() !== 'Shopware\Kernel') {
            return [];
        }

        $constName = $node->name->toString();

        if (!isset(self::DEPRECATED_CONSTS[$constName])) {
            return [];
        }

        return [
            sprintf('Usage of Shopware\Kernel::%s is deprecated since Shopware 5.4 and will be removed in 5.6. Please use the config service with "%s" to get the value', $constName, self::DEPRECATED_CONSTS[$constName])
        ];
    }
}