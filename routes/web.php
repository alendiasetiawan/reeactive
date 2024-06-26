<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Member\ChangePassword;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CompanyProfile\PricelistController;
use App\Livewire\Member\Registrations\FormNewMember;
use App\Livewire\Member\Registrations\FormWorkshop;
use App\Livewire\Member\RegistrationSuccess;
use App\Livewire\ResetPassword;
use App\Livewire\WatchPrivateVideo;

Auth::routes();
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


require __DIR__ . '/member.php';

require __DIR__ . '/admin.php';

require __DIR__ . '/coach.php';

require __DIR__ . '/trainer.php';
