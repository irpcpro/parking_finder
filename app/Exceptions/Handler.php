<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            $error_code = 401;
            $getResponse = APIResponse(Lang::get('msg.request.error_unauthorized'), $error_code, false)->get();
            return new JsonResponse(
                $getResponse->original,
                $error_code,
                [],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            );
        }

        return parent::unauthenticated($request, $exception);
    }

    protected function prepareJsonResponse($request, Throwable $e)
    {
        if(!isset($this->convertExceptionToArray($e)['message']) || $this->convertExceptionToArray($e)['message'] == ""){
            if($e instanceof AccessDeniedHttpException)
                $message = Lang::get('msg.request.error_unauthorized');
            else
                $message = Lang::get('msg.request.error_crash');
        }else{
            $message = $this->convertExceptionToArray($e)['message'];
        }
        $error_code = $this->isHttpException($e) ? $e->getStatusCode() : 500;
        $getResponse = APIResponse($message, $error_code, false)->get();
        return new JsonResponse(
            $getResponse->original,
            $error_code,
            $this->isHttpException($e) ? $e->getHeaders() : [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }

}
