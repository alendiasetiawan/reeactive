<?php

use App\Livewire\Coach\DashboardCoach;
use App\Livewire\Coach\Database\ActiveMembers;
use App\Livewire\Coach\Database\ClassRoom;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'coach'], 'as' => 'coach::'], function() {
    Route::prefix('coach')->group(function() {
        //Dashboard
        Route::get('/dashboard', DashboardCoach::class)->name('dashboard');

        //Database
        Route::get('/member', ActiveMembers::class)->name('active_members');
        Route::get('/kelas', ClassRoom::class)->name('class_room');
    });
});
