<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \TypiCMS\Modules\Core\Http\Middleware\PublicLocale::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'admin' => \TypiCMS\Modules\Core\Http\Middleware\Admin::class,
        'auth' => \TypiCMS\Modules\Core\Http\Middleware\Authenticate::class,
        'publicAccess' => \TypiCMS\Modules\Core\Http\Middleware\PublicAccess::class,
        'publicCache' => \TypiCMS\Modules\Core\Http\Middleware\PublicCache::class,
        'registration' => \TypiCMS\Modules\Core\Http\Middleware\Registration::class,
    ];
}
