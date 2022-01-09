<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException) {
            return $this->apiResponse(404, "error 404", $request->url() . ' Not Found, try with correct url');
        }
        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->apiResponse(405, "error 405", $request->method() . ' method Not allow for this route, try with correct method');
        }
        if ($e instanceof ValidationException) {
            return $this->apiResponse(400, "Validation errors", $e->errors());
        }
        if ($e instanceof AuthorizationException) {
            return $this->apiResponse(403, "unauthorized");
        }
    }
}
