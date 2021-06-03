<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Menu\MenuController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Report\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    //auth
    Route::get('auth', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('profile', [AuthController::class, 'profile'])->name('auth.profile');

    //products
    Route::resource('menu', MenuController::class);

    //user
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('order', OrderController::class);
    // Route::get('user/roles', [UserController::class, 'rolelist'])->name('user.rolelist');
    Route::post('menu/{id}', [MenuController::class, 'update'])->name('menu.updatepost');
    Route::post('user/{id}', [UserController::class, 'update'])->name('user.updatepost');

    //categories
    Route::get('categories', [CategoryController::class, 'categorylist'])->name('category.categorylist');

    //order

    //report
    Route::get('/report/dashboarddaily', [ReportController::class, 'dashboardDailyReport']);
    Route::get('/report/dashboardweekly', [ReportController::class, 'dashboardWeeklyReport']);
    Route::get('/report/dashboardyearly', [ReportController::class, 'dasboardYearlyReport']);
    Route::get('/report/dashboardrecenttransaction', [ReportController::class, 'dashboardRecentTransaction']);
});

//auth
Route::post('auth', [AuthController::class, 'login'])->name('auth.login');