<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PaymentVerificationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin'], 'as' => 'admin::'], function() {
    Route::prefix('admin')->group(function() {

        //Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        //Finance
        Route::get('/verifikasi-transfer', [PaymentVerificationController::class, 'index'])->name('payment_verification');
    });
});
