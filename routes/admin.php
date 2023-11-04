<?php

use App\Http\Controllers\ExportExcelController;
use App\Livewire\Admin\DashboardAdmin;
use App\Livewire\Admin\DatabaseMember;
use App\Livewire\Admin\PaymentVerification;
use App\Livewire\Admin\RegistrationQuota;
use App\Livewire\Admin\Registrations\ShowMemberInClass;
use App\Livewire\Admin\Registrations\ShowWorkshopVerification;
use App\Livewire\Admin\Registrations\WorkshopPaymentVerification;
use App\Livewire\Admin\ShowPaymentVerification;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin'], 'as' => 'admin::'], function() {
    Route::prefix('admin')->group(function() {

        //Dashboard
        Route::get('/dashboard', DashboardAdmin::class)->name('dashboard');

        //Database
        Route::get('/database-member', DatabaseMember::class)->name('database_member');

        //Download Excel
        Route::get('/excel-all-member/{batch_id}', [ExportExcelController::class, 'allMember'])->name('excel_all_member');
        Route::get('/excel-per-coach/{coach_id}', [ExportExcelController::class, 'perCoach'])->name('excel_per_coach');
        Route::get('/excel-per-class', [ExportExcelController::class, 'perClass'])->name('excel_per_class');

        //Registration
        Route::get('/verifikasi-transfer', PaymentVerification::class)->name('payment_verification');
        Route::get('/verifikasi-transfer/{id}', ShowPaymentVerification::class)->name('payment_verification.show');
        Route::get('/kuota-pendaftaran', RegistrationQuota::class)->name('registration_quota');
        Route::get('/member-per-kelas/{classId}/{batchId}/{nickName}', ShowMemberInClass::class)->name('member_in_class');

        //Workshop
        Route::get('/verifikasi-transfer-workshop', WorkshopPaymentVerification::class)->name('workshop_verification');
        Route::get('/verifikasi-transfer-workshop/{id}', ShowWorkshopVerification::class)->name('workshop_verification.show');
    });
});
