<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Spatie\ResponseCache\Facades\ResponseCache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Event::listen('eloquent.saved:*', fn () => ResponseCache::clear());
        Event::listen('eloquent.deleted:*', fn () => ResponseCache::clear());
    }
}
