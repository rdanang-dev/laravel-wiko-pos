<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Menu\MenuController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Permission\PermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('profile', [AuthController::class, 'profile'])->name('auth.profile');
    Route::resource('menu', MenuController::class);
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::get('categories', [CategoryController::class, 'categorylist'])->name('category.categorylist');
    Route::resource('order', OrderController::class);
    Route::post('menu/{id}', [MenuController::class, 'update'])->name('menu.updatepost');
    Route::post('user/{id}', [UserController::class, 'update'])->name('user.updatepost');
    Route::get('permissions', [PermissionController::class, 'permissionlist'])->name('permission.permisions');
});

Route::post('auth', [AuthController::class, 'login'])->name('auth.login');