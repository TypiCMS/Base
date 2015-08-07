<?php

/* Simple configuration file for Laravel Sitemap package */
return [
    'use_cache'      => false,
    'cache_key'      => 'Laravel.Sitemap.' . config('app.url'),
    'cache_duration' => 3600,
    'escaping'       => true,
];