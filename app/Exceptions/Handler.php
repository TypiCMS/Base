<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
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
            $view = 'errors::admin.'.$statusCode;
        } else {
            $view = 'errors::'.$statusCode;
        }

        if (view()->exists($view)) {
            return $view;
        }

        $view = mb_substr($view, 0, -2).'xx';

        if (view()->exists($view)) {
            return $view;
        }

        return null;
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }
}
