<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;

Route::middleware('api')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);

    Route::get('/test-api', function () {
        return response()->json(['message' => 'API routes loaded']);
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('/images',    [ImageController::class, 'index']);
        Route::post('/images',   [ImageController::class, 'store']);
        Route::delete('/images', [ImageController::class, 'destroy']);
    });

});

