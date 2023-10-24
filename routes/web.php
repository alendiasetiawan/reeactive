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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/', [LandingPageController::class, 'index'])->name('home_page');
Route::get('/logout', [LoginController::class, 'logout']);
Route::controller(PricelistController::class)->group(function() {
    Route::get('/private-1-on-1', 'private');
    Route::get('/buddy-small-groups', 'buddySmall');
    Route::get('/special-case-groups', 'specialCase');
    Route::get('/large-groups', 'large');
});
Route::get('/member-baru', FormNewMember::class)->name('new_member');
Route::get('/registrasi-berhasil/{memberName}', RegistrationSuccess::class)->name('registration_success');

//Workshop
Route::get('/daftar-workshop', FormWorkshop::class)->name('workshop_register');
Route::get('/registrasi-workshop-berhasil/{memberName}', RegistrationSuccess::class)->name('workshop_registration_success');

//Change Password
Route::get('/ganti-password', ChangePassword::class)->name('ganti_password');

require __DIR__ . '/member.php';

require __DIR__ . '/admin.php';

require __DIR__ . '/coach.php';
