<?php

use App\Livewire\Member\MemberDashboard;
use App\Livewire\Member\RenewalRegistration;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'member'], 'as' => 'member::'], function() {
    Route::prefix('member')->group(function() {
        //Dashboard
        Route::get('/dashboard', MemberDashboard::class)->name('dashboard');

        // Registrasi Member Lama
        Route::get('/renewal-registration', RenewalRegistration::class)->name('renewal_registration');
    });
});
