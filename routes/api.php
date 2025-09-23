<?php

use App\Http\Controllers\Api\StokIkanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Auth\SSOController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::as('api.')
    // ->middleware('auth:sso-api')
    ->group(function () {
        Route::get('/whoami',  [SSOController::class, 'whoami'])->name('whoami');

        Route::get('/products',  [TransaksiController::class, 'indexProduct'])->name('product.index');
        Route::get('/products2',  [TransaksiController::class, 'indexProduct2'])->name('product.index2');
        Route::get('/products/{id}/thumbnail',  [TransaksiController::class, 'getImage'])->name('product.image');
        Route::resource('transactions', TransaksiController::class)->names('transactions');
        Route::resource('fish-stock', StokIkanController::class)->names('fish-stock');
    });
