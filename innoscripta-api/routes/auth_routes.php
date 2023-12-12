<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\auth\AuthController;

Route::prefix('/v1')->group(function () {

    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
