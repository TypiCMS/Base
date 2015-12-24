<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Krucas\Notification\Facades\Notification;
use Symfony\Component\Debug\ExceptionHandler as SymfonyDisplayer;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        if ($this->shouldReport($e)) {
            Log::error($e);
        }

        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {

        /*
         * Error 404 when a model is not found
         */
        if ($e instanceof ModelNotFoundException) {
            return response()->view('errors.404', [], 404);
        }

        /*
         * Notification on TokenMismatchException
         */
        if ($e instanceof TokenMismatchException) {
            Notification::error(trans('global.Security token expired. Please, repeat your request.'));

            return redirect()->back()->withInput();
        }

        if ($this->isHttpException($e)) {
            return $this->toIlluminateResponse($this->renderHttpException($e), $e);
        } else {
            // Custom error 500 view on production
            if (app()->environment() == 'production') {
                return response()->view('errors.500', [], 500);
            }

            return $this->toIlluminateResponse((new SymfonyDisplayer(config('app.debug')))->createResponse($e), $e);
        }
        return parent::render($request, $e);
    }
}
