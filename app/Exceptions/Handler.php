<?php

namespace App\Exceptions;

use App\Exceptions\Api\ApiException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            $exception = $this->prepareException($exception);
            $code = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : $exception->getCode();
            $message = $exception->getMessage();

            if ($exception instanceof AuthenticationException) {
                return response()->error($message, null, HTTP_UNAUTHORIZED);
            } elseif ($exception instanceof ApiException) {
                return response()->error($message, null, $code);
            }

            return config('app.debug') ? response()->error($message, null, $code) : response()->error();
        }

        return parent::render($request, $exception);
    }
}
