<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->renderable(function (\Throwable $e, $request) {
            if ($request->is('api/*')) {
                return $this->handleApiException($e);
            }
        });
    }

    protected function handleApiException(\Throwable $e)
    {
        if ($e instanceof \App\Exceptions\ApiException) {
            return \App\Http\Responses\ApiResponse::error($e->getMessage(), $e->getCode() ?: 400, $e->errorCode);
        }

        if ($e instanceof \Illuminate\Auth\AuthenticationException) {
            return \App\Http\Responses\ApiResponse::error('Unauthenticated', 401, 'AUTH_FAILED');
        }

        if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return \App\Http\Responses\ApiResponse::error('Forbidden', 403, 'AUTH_FORBIDDEN');
        }

        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return \App\Http\Responses\ApiResponse::error('Resource not found', 404, 'RESOURCE_NOT_FOUND');
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            if ($e->getPrevious() instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return \App\Http\Responses\ApiResponse::error('Resource not found', 404, 'RESOURCE_NOT_FOUND');
            }
            return \App\Http\Responses\ApiResponse::error('Endpoint not found', 404, 'ENDPOINT_NOT_FOUND');
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            return \App\Http\Responses\ApiResponse::error('Method not allowed', 405, 'METHOD_NOT_ALLOWED');
        }

        if ($e instanceof \Illuminate\Validation\ValidationException) {
            return \App\Http\Responses\ApiResponse::error('Validation failed', 422, 'VALIDATION_ERROR', $e->errors());
        }

        if ($e instanceof \Illuminate\Database\QueryException) {
            $message = config('app.debug') ? $e->getMessage() : 'Database Error';
            return \App\Http\Responses\ApiResponse::error($message, 500, 'DB_ERROR');
        }

        // Generic Handler
        $message = config('app.debug') ? $e->getMessage() : 'Server Error';
        return \App\Http\Responses\ApiResponse::error($message, 500, 'SERVER_ERROR');
    }
}
