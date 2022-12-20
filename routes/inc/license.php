<?php

use App\Http\Controllers\Front\FLicenseController;
use Illuminate\Support\Facades\Route;

Route::get('license', [FLicenseController::class, 'index'])->name('front.license.index');
Route::post('license', [FLicenseController::class, 'search'])->name('front.license.search')->middleware('throttle:license');
Route::get('license/{slug}', [FLicenseController::class, 'detail'])->name('front.license.detail')->middleware('throttle:license');
Route::post('license/claim', [FLicenseController::class, 'claim'])->name('front.license.claim')->middleware(['auth', 'verified']);
