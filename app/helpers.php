<?php

if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst($string, $encoding = 'UTF-8')
    {
        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);

        return mb_strtoupper($firstChar, $encoding).$then;
    }
}

if (!function_exists('column')) {
    function column($column)
    {
        return $column.'->'.config('app.locale');
    }
}

if (!function_exists('locales')) {
    function locales()
    {
        return array_keys(config('typicms.locales'));
    }
}

if (!function_exists('getMigrationFileName')) {
    function getMigrationFileName(string $name): string
    {
        $directory = database_path(DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR);
        $migrations = File::glob($directory.'*_'.$name.'.php');

        return $migrations[0] ?? $directory.date('Y_m_d_His').'_'.$name.'.php';
    }
}
