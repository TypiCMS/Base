<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if (app()->bound('sentry')) {
                \Sentry\configureScope(function (\Sentry\State\Scope $scope): void {
                    $scope->setUser($this->getUserInfo(), true);
                });
                app('sentry')->captureException($e);
            }
        });
    }

    /**
     * Get logged user info.
     */
    private function getUserInfo(): array
    {
        $guard = $this->activeGuard();
        if ($user = auth($guard)->user()) {
            return [
                'id' => $guard . '-with-id-' . $user->id,
                'email' => $user->email,
            ];
        }

        return [];
    }

    /**
     * Get the current guard.
     */
    private function activeGuard(): ?string
    {
        foreach (array_keys(config('auth.guards')) as $guard) {
            if (auth($guard)->check()) {
                return $guard;
            }
        }

        return null;
    }

    /**
     * Get the view used to render HTTP exceptions.
     *
     * @return null|string
     */
    protected function getHttpExceptionView(HttpExceptionInterface $e)
    {
        $statusCode = $e->getStatusCode();
        if (request()->segment(1) === 'admin' && view()->exists("errors::admin.{$statusCode}")) {
            $view = 'errors::admin.' . $statusCode;
        } else {
            $view = 'errors::' . $statusCode;
        }
        if (view()->exists($view)) {
            return $view;
        }
        $view = mb_substr($view, 0, -2) . 'xx';
        if (view()->exists($view)) {
            return $view;
        }

        return null;
    }
}
