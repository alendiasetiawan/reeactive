<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Member\DashboardMember;
use App\Livewire\Member\Programs\ReferralMember;
use App\Http\Controllers\Member\DownloadVoucherMerchandise;
use App\Livewire\Member\Registrations\ContinueWorkshopForm;
use App\Http\Controllers\Member\RenewalRegistrationController;

Route::group(['middleware' => ['auth', 'member'], 'as' => 'member::'], function() {
    Route::prefix('member')->group(function() {
        //Dashboard
        Route::get('/dashboard', DashboardMember::class)->name('dashboard');

        // Registrasi Member Lama
        Route::controller(RenewalRegistrationController::class)->group(function() {
            Route::get('/renewal-registration', 'index')->name('renewal_registration');
            Route::get('/renewal-registration/{id}', 'show')->name('renewal_registration.show');
        });
        Route::get('/workshop-lanjutan', ContinueWorkshopForm::class)->name('continue_workshop_form');
        Route::get('/referral-member', ReferralMember::class)->name('referral_member');

        //Reeactive Loyalty Program
        Route::get('/download-voucher-merchandise/{id}', [DownloadVoucherMerchandise::class, 'create'])->name('download_voucher_merchandise.create');
    });
});
