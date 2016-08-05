<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Session\Middleware\StartSession::class,
        \TypiCMS\Modules\Core\Http\Middleware\SetLocale::class,
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Krucas\Notification\Middleware\NotificationMiddleware::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
        ],

        'public' => [
            'web',
            \TypiCMS\Modules\Core\Http\Middleware\PublicAccess::class,
            \TypiCMS\Modules\Core\Http\Middleware\PublicCache::class,
        ],

        'admin' => [
            'web',
            'auth',
            'authorization',
            \TypiCMS\Modules\Core\Http\Middleware\AdminLocale::class,
            \TypiCMS\Modules\Core\Http\Middleware\JavaScriptData::class,
            \TypiCMS\Modules\Core\Http\Middleware\UserPrefs::class,
        ],

        'api' => [
            'auth',
            'authorization',
            \TypiCMS\Modules\Core\Http\Middleware\AdminLocale::class,
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'authorization' => \TypiCMS\Modules\Core\Http\Middleware\Authorization::class,
        'registrationAllowed' => \TypiCMS\Modules\Core\Http\Middleware\RegistrationAllowed::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
