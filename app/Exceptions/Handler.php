<?php

namespace App\Exceptions;

use App\Domain\Group\GroupException;
use App\Domain\GroupPolicySetting\GroupPolicySettingException;
use App\Domain\Layout\LayoutException;
use App\Domain\UserGroup\UserGroupException;
use App\Traits\ResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseTrait;

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
        GroupException::class,
        GroupPolicySettingException::class,
        LayoutException::class,
        UserGroupException::class,
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

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        //HTTP Error Code 405
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'success' => false,
                'status' => Response::HTTP_METHOD_NOT_ALLOWED,
                'message' => '405 Method Not Allowed',
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        //HTTP Error Code 404
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'success' => false,
                'status' => Response::HTTP_NOT_FOUND,
                'message' => '404 Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof ValidationException) {
            return $this->errorResponse(
                'validation_error',
                $exception->validator->errors()->toArray(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if ($exception instanceof HttpException) {
            return $this->errorResponse($exception->getMessage(), [], $exception->getStatusCode());
        }

        return parent::render($request, $exception);
    }
}
