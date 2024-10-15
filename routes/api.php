<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductPurchaseController;
use App\Http\Controllers\ProductRentController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])
    ->name('register');

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/', function () {
        return 'meow';
    });

    Route::post('/product/{productId}/purchase', [ProductPurchaseController::class, 'purchase'])
        ->whereNumber('productId');
    Route::post('/product/{productId}/rent', [ProductRentController::class, 'rent'])
        ->whereNumber('productId');

    Route::post('/rent/{rentId}/extend', [ProductRentController::class, 'extendRent'])
        ->whereNumber('rentId');
});



