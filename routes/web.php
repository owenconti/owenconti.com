<?php

use App\Actions\User\UpdateUser;
use App\Http\Controllers\Profile\EditProfileController;
use App\Http\Controllers\Settings\ShowSettingsController;
use App\Http\Controllers\ShowDashboardController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::redirect('/', '/dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', ShowDashboardController::class)->name('dashboard.show');

    Route::get('/profile', EditProfileController::class)->name('profile.edit');
    Route::put('/profile', UpdateUser::class)->name('profile.update');

    Route::get('/settings', ShowSettingsController::class)->name('settings.show');
});
