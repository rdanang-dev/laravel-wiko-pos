<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Menu\MenuController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Order\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('profile', [AuthController::class, 'profile'])->name('auth.profile');
    Route::resource('menu', MenuController::class);
    Route::resource('user', UserController::class);
    Route::resource('order',OrderController::class);
});

Route::post('auth', [AuthController::class, 'login'])->name('auth.login');
