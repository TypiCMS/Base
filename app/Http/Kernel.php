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
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
        ],

        'api' => [
            'authorization',
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
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
        'admin' => \TypiCMS\Modules\Core\Http\Middleware\Admin::class,
        'authorization' => \TypiCMS\Modules\Core\Http\Middleware\Authorization::class,
        'publicAccess' => \TypiCMS\Modules\Core\Http\Middleware\PublicAccess::class,
        'publicLocale' => \TypiCMS\Modules\Core\Http\Middleware\PublicLocale::class,
        'publicCache' => \TypiCMS\Modules\Core\Http\Middleware\PublicCache::class,
        'registration' => \TypiCMS\Modules\Core\Http\Middleware\Registration::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
