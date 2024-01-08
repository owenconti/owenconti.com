<?php

// Reference: http://cs.sensiolabs.org/
// Usage: php-cs-fixer fix app

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['bootstrap', 'storage', 'vendor', 'node_modules'])
    ->name('*.php')
    ->name('_ide_helper')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        '@PHP70Migration' => true,
        '@PHP71Migration' => true,
        'multiline_whitespace_before_semicolons' => false,
        'array_syntax' => ['syntax' => 'short'],
        'simplified_null_return' => false,
        'strict_comparison' => true,
        'strict_param' => true,
        'yoda_style' => false,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
        'phpdoc_add_missing_param_annotation' => false,
        'phpdoc_separation' => false,
        'phpdoc_align' => ['align' => 'left'],
        'global_namespace_import' => ['import_classes' => true, 'import_constants' => true, 'import_functions' => true],
    ])
    ->setFinder($finder);
