<?php

use App\Livewire\Coach\DashboardCoach;
use App\Livewire\Coach\Database\ActiveMembers;
use App\Livewire\Coach\Database\ClassRoom;
use App\Livewire\Coach\Database\CreateClassRoom;
use App\Livewire\Coach\Database\OpenClassMember;
use App\Livewire\Coach\MemberPortal;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'coach'], 'as' => 'coach::'], function() {
    Route::prefix('coach')->group(function() {
        //Dashboard
        Route::get('/dashboard', DashboardCoach::class)->name('dashboard');

        //Database
        Route::get('/member', ActiveMembers::class)->name('active_members');
        Route::get('/kelas', ClassRoom::class)->name('class_room');
        Route::get('/portal-member', MemberPortal::class)->name('member_portal');
        Route::get('/member-kelas-lepasan', OpenClassMember::class)->name('open_class_member');
    });
});
