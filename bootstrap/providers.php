<?php

use App\Providers\AppServiceProvider;
use TypiCMS\LaravelTranslatableBootForms\TranslatableBootFormsServiceProvider;
use TypiCMS\Modules\Core\Providers\ModuleServiceProvider;
use TypiCMS\Modules\Core\Providers\TranslationsServiceProvider;
use TypiCMS\Modules\Sidebar\SidebarServiceProvider;
use Typidesign\Translations\ArtisanTranslationsServiceProvider;

return [
    // Package Service Providers.
    SidebarServiceProvider::class,
    ArtisanTranslationsServiceProvider::class,
    TranslatableBootFormsServiceProvider::class,
    TranslationsServiceProvider::class,

    // TypiCMS Core Service Provider.
    ModuleServiceProvider::class,

    // TypiCMS Modules Service Providers.
    // TypiCMS\Modules\News\Providers\ModuleServiceProvider::class,

    // Application Service Providers.
    AppServiceProvider::class,
];
