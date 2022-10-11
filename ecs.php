<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Casing\ConstantCaseFixer;
use PhpCsFixer\Fixer\Casing\LowercaseStaticReferenceFixer;
use PhpCsFixer\Fixer\Casing\MagicMethodCasingFixer;
use PhpCsFixer\Fixer\ClassNotation\FinalClassFixer;
use PhpCsFixer\Fixer\ControlStructure\ElseifFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/ecs.php',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ]);

    $ecsConfig->sets([SetList::PSR_12, SetList::CLEAN_CODE, SetList::COMMON]);

    $ecsConfig->rules([
        ReturnTypeDeclarationFixer::class,
        VoidReturnFixer::class,
        LowercaseStaticReferenceFixer::class,
        MagicMethodCasingFixer::class,
        DeclareStrictTypesFixer::class,
        ElseifFixer::class,
        FinalClassFixer::class,
    ]);
    $ecsConfig->ruleWithConfiguration(OrderedImportsFixer::class, [
        'sort_algorithm' => 'alpha',
    ]);
    $ecsConfig->ruleWithConfiguration(ConstantCaseFixer::class, [
        'case' => 'lower',
    ]);
    $ecsConfig->ruleWithConfiguration(\PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer::class, [
        'statements' => ['return'],
    ]);
};
