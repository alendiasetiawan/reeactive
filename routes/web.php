<?php

use App\Livewire\PasswordBaru;
use App\Livewire\PrivacyPolicy;
use App\Livewire\ResetPassword;
use App\Livewire\WatchPrivateVideo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Member\ChangePassword;
use App\Livewire\Member\RegistrationSuccess;
use App\Http\Controllers\Auth\LoginController;
use App\Livewire\VoucherMerchandiseValidation;
use App\Http\Controllers\LandingPageController;
use App\Livewire\Member\Registrations\FormWorkshop;
use App\Livewire\Member\Registrations\FormNewMember;
use App\Http\Controllers\CompanyProfile\PricelistController;

Auth::routes();
Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy_policy');
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/logout', [LoginController::class, 'logout']);
Route::controller(PricelistController::class)->group(function() {
    Route::get('/private-1-on-1', 'private');
    Route::get('/buddy-small-groups', 'buddySmall');
    Route::get('/special-case-groups', 'specialCase');
    Route::get('/large-groups', 'large');
});
Route::get('/member-baru', FormNewMember::class)->name('new_member');
Route::get('/registrasi-berhasil/{memberName}/{programName}/{coachFullName}/{coachNickName}/{classDay}/{classStartTime}/{classEndTime}/{email}', RegistrationSuccess::class)->name('registration_success');

//Workshop
Route::get('/daftar-workshop', FormWorkshop::class)->name('workshop_register');
Route::get('/registrasi-workshop-berhasil/{memberName}', RegistrationSuccess::class)->name('workshop_registration_success');
Route::get('/private-video', WatchPrivateVideo::class)->name('private_video');

//Change Password
Route::get('/ganti-password', ChangePassword::class)->name('ganti_password');
Route::get('/reset-password', ResetPassword::class)->name('reset_password');
Route::get('/link-reset/{resetCode}', PasswordBaru::class)->name('password_baru');

//Loyalti Program
Route::get('/validasi-voucher/{code}', VoucherMerchandiseValidation::class)->name('voucher_merchandise_validation');

require __DIR__ . '/member.php';

require __DIR__ . '/admin.php';

require __DIR__ . '/coach.php';

require __DIR__ . '/trainer.php';
