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
    Route::get('auth', [AuthController::class, 'logout'])->name("auth.logout");
    Route::get('profile', [AuthController::class, 'profile'])->name("auth.profile");

    // User
    Route::resource('user', UserController::class);
    Route::post('user/{id}', [UserController::class, 'update'])->name("user.update");
    // Route::get('user/roles', [UserController::class, 'rolelist']);

    // Roles
    Route::get('roles', [PermissionController::class, 'rolelist'])->name("permission.rolelist");

    //Products
    Route::resource('menu', MenuController::class);
    Route::post('menu/{id}', [MenuController::class, 'update'])->name("menu.update");

    // Category
    Route::resource('category', CategoryController::class);
    Route::get('categories', [CategoryController::class, 'categorylist'])->name("category.categorylist");

    // Order
    Route::resource('order', OrderController::class);
    Route::get('getcount', [OrderController::class, 'getUnfinishedTransactionCount'])->name("order.getUnfinishedTransactionCount");

    // Dashboard Report
    Route::get('/report/dashboarddaily', [ReportController::class, 'dashboardDailyReport'])->name("report.dashboardDailyReport");
    Route::get('/report/dashboardweekly', [ReportController::class, 'dashboardWeeklyReport'])->name("report.dashboardWeeklyReport");
    Route::get('/report/dashboardyearly', [ReportController::class, 'dasboardYearlyReport'])->name("report.dasboardYearlyReport");
    Route::get('/report/dashboardrecenttransaction', [ReportController::class, 'dashboardRecentTransaction'])->name("report.dashboardRecentTransaction");

    // Report
    Route::get('/report/daily', [ReportController::class, 'dailyReport'])->name("report.dailyReport");
    Route::get('/report/weekly', [ReportController::class, 'weeklyReport'])->name("report.weeklyReport");
    Route::get('/report/monthly', [ReportController::class, 'monthlyReport'])->name("report.monthlyReport");
    Route::get('/report/yearly', [ReportController::class, 'yearlyReport'])->name("report.yearlyReport");
    Route::get('/report/alltransaction', [ReportController::class, 'allTransactionReport'])->name("report.allTransactionReport");
    Route::get('/report/exportcustom', [ReportController::class, 'exportcustom'])->name("report.exportcustom");
});

//Login
Route::post('auth', [AuthController::class, 'login'])->name("auth.login");