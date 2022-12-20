<?php

use App\Http\Controllers\Front\FProfileController;
use Illuminate\Support\Facades\Route;

Route::get('p/{user:username}', [FProfileController::class, 'index'])->name('front.profile.index');
Route::group(['middleware' => ['auth']], function () {
    Route::get('profile/settings', [FProfileController::class, 'settings'])->name('front.profile.settings');
    Route::get('profile/settings/security', [FProfileController::class, 'settings'])->name('front.profile.settings.security');
    Route::post('profile/settings/update/{type}', [FProfileController::class, 'settings_update'])->name('front.profile.settings.update')->middleware('throttle:update_profile_settings');
    Route::get('profile/settings/whatsapp', [FProfileController::class, 'settings'])->name('front.profile.settings.whatsapp')->middleware('password.confirm');
});


Route::prefix('library')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [FProfileController::class, 'library'])->name('front.library.index');
    Route::get('download', [FProfileController::class, 'download'])->name('front.library.download');
    Route::get('store/{id}', [FProfileController::class, 'library_store'])->name('front.library.add');
});
