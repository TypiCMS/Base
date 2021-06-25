<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
        if ($this->shouldReport($exception) && app()->bound('sentry')) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Throwable
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        $locale = ($request->segment(1) === 'admin') ? config('typicms.admin_locale') : config('app.locale');

        if ($exception instanceof TokenMismatchException) {
            return redirect()
                ->back()
                ->withErrors(['token_error' => __('Sorry, your session has expired. Please refresh and try again.', [], $locale)])
                ->withInput();
        }

        return parent::render($request, $exception);
    }

    /**
     * Render the given HttpException.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderHttpException(HttpExceptionInterface $e)
    {
        $this->registerErrorViewPaths();

        $status = $e->getStatusCode();
        if (request()->segment(1) === 'admin' && view()->exists("errors::admin.{$status}")) {
            return response()->view("errors::admin.{$status}", ['exception' => $e], $status, $e->getHeaders());
        }
        if (view()->exists("errors::{$status}")) {
            return response()->view("errors::{$status}", ['exception' => $e], $status, $e->getHeaders());
        }

        return $this->convertExceptionToResponse($e);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
    }
}
