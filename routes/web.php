<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login');

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::prefix('transactions')->group(function () {
        Route::get('index', [TransactionController::class, 'index'])->name('transactions.transaction');
    });
});