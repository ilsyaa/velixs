<?php

use App\Http\Controllers\Front\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('index');

// privacy policy & terms of condition
Route::get('privacy-policy', function () {
    return view('privacy-policy');
})->name('policy.show');

Route::get('terms', function () {
    return view('terms');
})->name('terms.show');
