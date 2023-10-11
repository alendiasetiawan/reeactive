<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Member\RenewalRegistrationController;
use App\Livewire\Member\ChangePassword;
use App\Livewire\Member\DashboardMember;

Route::group(['middleware' => ['auth', 'member'], 'as' => 'member::'], function() {
    Route::prefix('member')->group(function() {
        //Dashboard
        // Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', DashboardMember::class)->name('dashboard');

        // Registrasi Member Lama
        Route::controller(RenewalRegistrationController::class)->group(function() {
            Route::get('/renewal-registration', 'index')->name('renewal_registration');
            Route::get('/renewal-registration/{id}', 'show')->name('renewal_registration.show');
        });
    });
});
