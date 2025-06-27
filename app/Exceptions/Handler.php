<?php

namespace App\Exceptions;

use Throwable;
use App\Helpers\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        //
    }

    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {
            return ApiResponse::handleException($e);
        }

        return parent::render($request, $e);
    }
}
