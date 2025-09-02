<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransaksiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::as('api.')->group(function () {
    Route::get('/product/{id}',  [TransaksiController::class, 'getImage'])->name('product.image');
    Route::resource('transaksi', TransaksiController::class)->names('transaksi');
});
