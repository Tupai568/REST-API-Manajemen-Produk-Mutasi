<?php

namespace App\Helpers;

use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiResponse
{
    public static function success($data = null, $message = 'Success', $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
            'timestamp' => now()->toDateTimeString(),
        ], $status);
    }

    public static function error($message = 'Error', $errors = null, $status = 400)
    {
        $response = [
            'success' => false,
            'message' => $message,
            'timestamp' => now()->toDateTimeString(),
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $status);
    }

    public static function handleException(Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return self::error('Validasi gagal', $e->errors(), 422);
        }

        if ($e instanceof ModelNotFoundException) {
            return self::error('Data tidak ditemukan', null, 404);
        }

        if ($e instanceof HttpException) {
            return self::error($e->getMessage(), null, $e->getStatusCode());
        }

        return self::error(
            'Terjadi kesalahan pada server',
            env('APP_DEBUG') ? ['exception' => $e->getMessage()] : null,
            500
        );
    }
}
