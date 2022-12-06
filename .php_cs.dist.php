<?php declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude(__DIR__ . '/tests')
;

return (new PhpCsFixer\Config())
    ->registerCustomFixers(new PhpCsFixerCustomFixers\Fixers())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@PSR12:risky' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'linebreak_after_opening_tag' => true,
        'mb_str_functions' => true,
        'no_php4_constructor' => true,
        'no_unreachable_default_argument_value' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'php_unit_strict' => true,
        'phpdoc_order' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'concat_space' => false,
        'declare_strict_types' => true,
        'native_function_invocation' => ['include' => []],
        PhpCsFixerCustomFixers\Fixer\DeclareAfterOpeningTagFixer::name() => true,
        PhpCsFixerCustomFixers\Fixer\NoDoctrineMigrationsGeneratedCommentFixer::name() => true,
        PhpCsFixerCustomFixers\Fixer\NoImportFromGlobalNamespaceFixer::name() => true,
        PhpCsFixerCustomFixers\Fixer\PromotedConstructorPropertyFixer::name() => true,
        PhpCsFixerCustomFixers\Fixer\ConstructorEmptyBracesFixer::name() => true,
        PhpCsFixerCustomFixers\Fixer\MultilinePromotedPropertiesFixer::name() => true,
        PhpCsFixerCustomFixers\Fixer\NoUselessDoctrineRepositoryCommentFixer::name() => true,
    ])
    ->setFinder($finder)
;
