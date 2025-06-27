<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LokasiController;
use App\Http\Controllers\Api\MutasiController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\Auth\ApiAuthController;
use App\Http\Controllers\Api\ProdukLokasiController;

Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/me', [ApiAuthController::class, 'me']);

    Route::apiResource('produk', ProdukController::class);
    Route::apiResource('lokasi', LokasiController::class);
    Route::apiResource('produk-lokasi', ProdukLokasiController::class);
    Route::apiResource('mutasi', MutasiController::class);
});
