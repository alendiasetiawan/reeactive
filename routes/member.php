<?php

use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Member\RenewalRegistrationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'member'], 'as' => 'member::'], function() {
    Route::prefix('member')->group(function() {
        //Dashboard
        Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard_member');

        // Registrasi Member Lama
        Route::controller(RenewalRegistrationController::class)->group(function() {
            Route::get('/renewal-registration', 'index')->name('renewal_registration');
        });
    });
});
