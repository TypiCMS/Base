<?php

/* Simple configuration file for Laravel Sitemap package */
return [
    'use_cache' => false,
    'cache_key' => 'sitemap.'.config('app.url'),
    'cache_duration' => 3600,
    'escaping' => true,
    'use_limit_size' => false,
    'max_size' => null,
    'use_styles' => false,
    'styles_location' => '/vendor/sitemap/styles/',
    'use_gzip' => false
];
