<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Menu\MenuController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Permission\PermissionController;
use App\Http\Controllers\Api\Report\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::get('auth', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);

    // User
    Route::resource('user', UserController::class);
    Route::post('user/{id}', [UserController::class, 'update']);
    // Route::get('user/roles', [UserController::class, 'rolelist']);

    // Roles
    Route::get('roles', [PermissionController::class, 'rolelist']);

    //Products
    Route::resource('menu', MenuController::class);
    Route::post('menu/{id}', [MenuController::class, 'update']);

    // Category
    Route::resource('category', CategoryController::class);
    Route::get('categories', [CategoryController::class, 'categorylist']);

    // Order
    Route::resource('order', OrderController::class);

    // Dashboard Report
    Route::get('/report/dashboarddaily', [ReportController::class, 'dashboardDailyReport']);
    Route::get('/report/dashboardweekly', [ReportController::class, 'dashboardWeeklyReport']);
    Route::get('/report/dashboardyearly', [ReportController::class, 'dasboardYearlyReport']);
    Route::get('/report/dashboardrecenttransaction', [ReportController::class, 'dashboardRecentTransaction']);

    // Report
    Route::get('/report/daily', [ReportController::class, 'dailyReport']);
    Route::get('/report/weekly', [ReportController::class, 'weeklyReport']);
    Route::get('/report/monthly', [ReportController::class, 'monthlyReport']);
    Route::get('/report/yearly', [ReportController::class, 'yearlyReport']);
    Route::get('/report/alltransaction', [ReportController::class, 'allTransactionReport']);
    Route::get('/report/exportcustom', [ReportController::class, 'exportcustom']);
});

//Login
Route::post('auth', [AuthController::class, 'login']);