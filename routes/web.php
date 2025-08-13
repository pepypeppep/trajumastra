<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\NavigationController;
use App\Http\Controllers\Settings\PreferenceController;



Route::middleware('auth', 'verified')->group(function () {
    /* ---- Dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::redirect('/', '/dashboard');

    /* ---- My Profile */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ---- Settings */
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/navs', NavigationController::class);
    Route::resource('/preferences', PreferenceController::class);
    Route::put('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
});

require __DIR__.'/auth.php';
