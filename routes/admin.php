<?php

use App\Livewire\Admin\DashboardAdmin;
use App\Livewire\Admin\DatabaseMember;
use App\Livewire\Admin\PaymentVerification;
use App\Livewire\Admin\RegistrationQuota;
use App\Livewire\Admin\Registrations\ShowMemberInClass;
use App\Livewire\Admin\ShowPaymentVerification;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin'], 'as' => 'admin::'], function() {
    Route::prefix('admin')->group(function() {

        //Dashboard
        Route::get('/dashboard', DashboardAdmin::class)->name('dashboard');

        //Database
        Route::get('/database-member', DatabaseMember::class)->name('database_member');

        //Registration
        Route::get('/verifikasi-transfer', PaymentVerification::class)->name('payment_verification');
        Route::get('/verifikasi-transfer/{id}', ShowPaymentVerification::class)->name('payment_verification.show');
        Route::get('/kuota-pendaftaran', RegistrationQuota::class)->name('registration_quota');
        Route::get('/member-per-kelas/{classId}/{batchId}', ShowMemberInClass::class)->name('member_in_class');
    });
});
