<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Menu\MenuController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth', [AuthController::class, 'logout'])->name('auth.logout');
});
Route::resource('menu', MenuController::class);

Route::post('auth', [AuthController::class, 'login'])->name('auth.login');