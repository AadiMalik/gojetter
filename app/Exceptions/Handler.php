<?php

namespace App\Exceptions;

use App\Enums\ResponseMessage;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Handler extends ExceptionHandler
{
    // Use ResponseAPI Trait
    use ResponseAPI;
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            Log::info($e->getMessage());
        });
    }
    public function render($request, Throwable $exception)
    {

        if (
            !$exception instanceof ValidationException
            && !$exception instanceof NotFoundHttpException
            && !$exception instanceof AuthenticationException
        ) {

            if ($request->is('api/*')) {

                Log::error([
                    'url' => request()->fullUrl(),
                    'user_id' => auth()->id() ?? null,
                    'exception_type' => get_class($exception),
                    'message' => $exception->getMessage(),
                ]);

                return $this->error(
                    ResponseMessage::ERROR,
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }
        if ($exception instanceof ValidationException) {
            $errorMessages = collect($exception->errors())->flatten()->implode(' ');
            return $this->validationResponse($errorMessages);
        }
        if ($exception instanceof NotFoundHttpException) {
            return $this->error(ResponseMessage::NOT_FOUND, 404);
        }
        if ($exception instanceof AuthenticationException) {
            if ($request->is('api/*'))
                return $this->error('UnAuthorized', 401);
        } else if ($request->is('api/*') || $request->is('v2/api/*'))
            return $this->error($exception->getMessage(), 400);
    }
}
