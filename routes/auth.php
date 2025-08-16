<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SSOController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('guest')->group(function () {
    Route::post('/auth/sso/login', [SSOController::class, 'redirect'])->name('auth.sso.login');
});

Route::get('/auth/sso/callback', [SSOController::class, 'callback'])->name('auth.sso.callback');

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
