<?php

$config = new PhpCsFixer\Config();
$config->setRules([
    '@PSR12' => true,
    '@PhpCsFixer' => true,
    'mb_str_functions' => true,
    'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
    'modernize_types_casting' => true,
    'return_assignment' => false,
    'ordered_class_elements' => false,
    'single_line_comment_style' => false,
    'yoda_style' => false,
])
    ->setRiskyAllowed(true)
    ->setUsingCache(false);

return $config;
