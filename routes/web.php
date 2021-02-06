<?php


use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');

    Route::prefix('transactions')->group(function () {
        Route::get('index', [TransactionController::class, 'index'])->name('transactions.transaction');
    });
    Route::prefix('menus')->group(function () {
        Route::get('index', [MenuController::class, 'index'])->name('menus.menu');
    });
});