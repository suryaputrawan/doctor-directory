<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'master'], function () {
        //
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('user', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('user/{user}', [ProfileController::class, 'update'])->name('profile.update');

        Route::put('password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
    });
});