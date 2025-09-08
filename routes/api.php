<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Auth\SSOController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::as('api.')->middleware('auth:sso-api')->group(function () {
    Route::get('/whoami',  [SSOController::class, 'whoami'])->name('whoami');

    Route::get('/product/{id}',  [TransaksiController::class, 'getImage'])->name('product.image');
    Route::resource('transaksi', TransaksiController::class)->names('transaksi');
});
