<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductPurchaseController;
use App\Http\Controllers\ProductRentController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])
    ->name('register');

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/purchase', [ProductPurchaseController::class, 'purchase']);

    Route::prefix('rent')
        ->group(function () {
            Route::post('/', [ProductRentController::class, 'rent']);

            Route::post('/extend', [ProductRentController::class, 'extendRent']);
        });
});



