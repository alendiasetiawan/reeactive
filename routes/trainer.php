<?php

use App\Livewire\Trainer\DashboardTrainer;
use App\Livewire\Trainer\Database\ActiveMember;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'trainer'], 'as' => 'trainer::'], function() {
    Route::prefix('trainer')->group(function() {
        //Dashboard
        Route::get('/dashboard', DashboardTrainer::class)->name('dashboard');

        //Halaman Member
        Route::get('/members', ActiveMember::class)->name('active_member');
    });
});
