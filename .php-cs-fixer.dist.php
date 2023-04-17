<?php

$config = new PhpCsFixer\Config();
$config->setRules([
    '@PhpCsFixer' => true,
    '@PHP80Migration' => true,
    'mb_str_functions' => true,
    'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
    'modernize_types_casting' => true,
    'return_assignment' => false,
    'ordered_class_elements' => ['order' => ['use_trait']],
    'single_line_comment_style' => false,
    'yoda_style' => false,
    'global_namespace_import' => true,
    'concat_space' => ['spacing' => 'one'],
])
    ->setRiskyAllowed(true)
    ->setUsingCache(false);

return $config;
