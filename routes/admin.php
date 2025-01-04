<?php

use App\Http\Controllers\ExportExcelController;
use App\Livewire\Admin\DashboardAdmin;
use App\Livewire\Admin\DatabaseMember;
use App\Livewire\Admin\MerchandiseVoucherVerification;
use App\Livewire\Admin\MobileMainMenu;
use App\Livewire\Admin\PaymentVerification;
use App\Livewire\Admin\RegistrationQuota;
use App\Livewire\Admin\Registrations\RegisteredByReferral;
use App\Livewire\Admin\Registrations\ShowMemberInClass;
use App\Livewire\Admin\Registrations\ShowWorkshopVerification;
use App\Livewire\Admin\Registrations\WorkshopPaymentVerification;
use App\Livewire\Admin\RequestClass;
use App\Livewire\Admin\RequestResetPassword;
use App\Livewire\Admin\ShowPaymentVerification;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin'], 'as' => 'admin::'], function() {
    Route::prefix('admin')->group(function() {

        Route::get('/mobile-main-menu', MobileMainMenu::class)->name('mobile_main_menu');
        //Dashboard
        Route::get('/dashboard', DashboardAdmin::class)->name('dashboard');

        //Database
        Route::get('/database-member', DatabaseMember::class)->name('database_member');
        Route::get('/request-class', RequestClass::class)->name('request_class');

        //Download Excel
        Route::get('/excel-all-member/{batch_id}', [ExportExcelController::class, 'allMember'])->name('excel_all_member');
        Route::get('/excel-per-coach/{coachId}/{batchId}', [ExportExcelController::class, 'perCoach'])->name('excel_per_coach');
        Route::get('/excel-per-class', [ExportExcelController::class, 'perClass'])->name('excel_per_class');

        //Registration
        Route::get('/verifikasi-transfer', PaymentVerification::class)->name('payment_verification');
        Route::get('/verifikasi-transfer/{id}', ShowPaymentVerification::class)->name('payment_verification.show');
        Route::get('/kuota-pendaftaran', RegistrationQuota::class)->name('registration_quota');
        Route::get('/member-per-kelas/{classId}/{batchId}/{nickName}', ShowMemberInClass::class)->name('member_in_class');

        //Workshop
        Route::get('/verifikasi-transfer-workshop', WorkshopPaymentVerification::class)->name('workshop_verification');
        Route::get('/verifikasi-transfer-workshop/{id}', ShowWorkshopVerification::class)->name('workshop_verification.show');

        //Setting
        Route::get('/request-reset-password', RequestResetPassword::class)->name('request_reset_password');

        //Loyalty Program
        Route::get('/verifikasi-voucher-merchandise', MerchandiseVoucherVerification::class)->name('merchandise_voucher_verification');
        Route::get('/pendaftar-referral', RegisteredByReferral::class)->name('registered_by_referral');
    });
});
