<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Models\Page;

if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst(string $string, string $encoding = 'UTF-8'): string
    {
        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);

        return mb_strtoupper($firstChar, $encoding) . $then;
    }
}

if (!function_exists('homeUrl')) {
    function homeUrl(): string
    {
        $uri = '/';
        if (config('typicms.main_locale_in_url') || mainLocale() !== config('app.locale')) {
            $uri .= app()->getLocale();
        }

        return url($uri);
    }
}

if (!function_exists('column')) {
    function column(string $column): string
    {
        return $column . '->' . app()->getLocale();
    }
}

if (!function_exists('locales')) {
    function locales(): array
    {
        return array_keys(config('typicms.locales', []));
    }
}

if (!function_exists('enabledLocales')) {
    function enabledLocales(): array
    {
        $locales = [];
        foreach (locales() as $locale) {
            if (config('typicms.' . $locale . '.status') || request('preview')) {
                $locales[] = $locale;
            }
        }

        return $locales;
    }
}

if (!function_exists('localeAndRegion')) {
    function localeAndRegion(?string $separator = null, ?string $locale = null): ?string
    {
        $localeAndRegion = Arr::get(config('typicms.locales'), app()->getLocale());
        if (!is_null($separator)) {
            return str_replace('_', $separator, $localeAndRegion);
        }

        return $localeAndRegion;
    }
}

if (!function_exists('mainLocale')) {
    function mainLocale(): string
    {
        return Arr::first(locales());
    }
}

if (!function_exists('isLocaleEnabled')) {
    function isLocaleEnabled(string $locale): bool
    {
        return in_array($locale, enabledLocales());
    }
}

if (!function_exists('getBrowserLocaleOrMainLocale')) {
    function getBrowserLocaleOrMainLocale(): string
    {
        if ($locale = mb_substr(getenv('HTTP_ACCEPT_LANGUAGE'), 0, 2)) {
            if (in_array($locale, enabledLocales())) {
                return $locale;
            }
        }

        return mainLocale();
    }
}

if (!function_exists('modules')) {
    function modules(): array
    {
        $modules = config('typicms.modules');
        ksort($modules);

        return $modules;
    }
}

if (!function_exists('getModulesForSelect')) {
    function getModulesForSelect(): array
    {
        $modules = config('typicms.modules');
        $options = ['' => ''];
        foreach ($modules as $module => $properties) {
            if (isset($properties['linkable_to_page']) && $properties['linkable_to_page'] === true) {
                $options[$module] = __(ucfirst($module));
            }
        }
        asort($options);

        return $options;
    }
}

if (!function_exists('permissions')) {
    function permissions(): array
    {
        $permissions = [];
        foreach (config('typicms.modules') as $module => $data) {
            if (isset($data['permissions']) && is_array($data['permissions'])) {
                $key = __(ucfirst($module));
                $permissions[$key] = $data['permissions'];
            }
        }
        ksort($permissions, SORT_LOCALE_STRING);

        return $permissions;
    }
}

if (!function_exists('websiteTitle')) {
    function websiteTitle(?string $locale = null): ?string
    {
        return config('typicms.' . ($locale ?: app()->getLocale()) . '.website_title');
    }
}

if (!function_exists('appBaseline')) {
    function appBaseline(?string $locale = null): ?string
    {
        return config('typicms.' . ($locale ?: app()->getLocale()) . '.website_baseline');
    }
}

if (!function_exists('getMigrationFileName')) {
    function getMigrationFileName(string $name, int $count = 0): string
    {
        $directory = database_path(DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR);
        $migrations = File::glob($directory . '*_' . $name . '.php');

        return $migrations[0] ?? $directory . date('Y_m_d_His', time() + $count) . '_' . $name . '.php';
    }
}

if (!function_exists('getPagesLinkedToModule')) {
    function getPagesLinkedToModule($module = null): array
    {
        $module = mb_strtolower($module);
        $routes = app('typicms.routes');

        $pages = [];
        foreach ($routes as $page) {
            if ($page->module === $module) {
                $pages[] = $page;
            }
        }

        return $pages;
    }
}

if (!function_exists('getPageLinkedToModule')) {
    function getPageLinkedToModule($module = null): ?Page
    {
        $pages = getPagesLinkedToModule($module);

        return Arr::first($pages);
    }
}

if (!function_exists('feeds')) {
    function feeds(): Collection
    {
        $locale = config('app.locale');
        $feeds = collect(config('typicms.modules'))
            ->transform(function ($properties, $module) use ($locale) {
                $routeName = $locale . '::' . $module . '-feed';
                if (isset($properties['has_feed']) && $properties['has_feed'] === true && Route::has($routeName)) {
                    return ['url' => route($routeName, $module), 'title' => __(ucfirst($module) . ' feed') . ' – ' . websiteTitle()];
                }
            })->reject(function ($value) {
                return empty($value);
            });

        return $feeds;
    }
}

if (!function_exists('pageTemplates')) {
    function pageTemplates(): array
    {
        try {
            $directory = getTemplateDir();
            $files = File::files($directory);
        } catch (Exception $e) {
            $files = File::files(base_path('vendor/typicms/pages/src/resources/views/public'));
        }
        $templates = [];
        foreach ($files as $file) {
            $filename = File::name($file);
            if ($filename === 'default.blade') {
                continue;
            }
            $name = str_replace('.blade', '', $filename);
            if ($name[0] != '_' && $name != 'master') {
                $templates[$name] = ucfirst($name);
            }
        }

        return ['' => 'Default'] + $templates;
    }
}

if (!function_exists('pageSectionTemplates')) {
    function pageSectionTemplates(): array
    {
        try {
            $directory = getTemplateDir();
            $files = File::files($directory);
        } catch (Exception $e) {
            $files = File::files(base_path('vendor/typicms/pages/src/resources/views/public'));
        }
        $templates = [];
        foreach ($files as $file) {
            $filename = File::name($file);
            if ($filename === '_section-default.blade') {
                continue;
            }
            if (str_starts_with($filename, '_section-')) {
                $name = str_replace(['_section-', '.blade'], '', $filename);
                $templates[$name] = ucfirst($name);
            }
        }

        return ['default' => 'Default'] + $templates;
    }
}

if (!function_exists('getTemplateDir')) {
    function getTemplateDir(): string
    {
        $templateDir = config('typicms.template_dir', 'public');
        $viewPath = app()['view']->getFinder()->getHints()['pages'][0];

        return rtrim($viewPath . DIRECTORY_SEPARATOR . $templateDir, DIRECTORY_SEPARATOR);
    }
}
