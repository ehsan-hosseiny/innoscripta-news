<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\user\UserController;

Route::middleware('auth:sanctum')->prefix('/v1')->group(function () {

    Route::prefix('/preferences')->group(function (){
        Route::get('/', [UserController::class, 'preferences'])->name('user.get.preferences');
        Route::post('/', [UserController::class, 'addPreferences'])->name('user.add.preferences');
        Route::delete('/{id}', [UserController::class, 'deletePreferences'])->name('user.delete.preferences');
    });
    Route::get('/sources', [UserController::class, 'sources'])->name('user.get.sources');

    Route::get('/news', [UserController::class, 'news'])->name('user.get.news');


});
