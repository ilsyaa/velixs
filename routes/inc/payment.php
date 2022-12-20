<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FPaymentController;

Route::get('payment/method', [FPaymentController::class, 'method'])->name('front.payment.method')->middleware('verified');

Route::prefix('payment')->middleware(['auth', 'verified'])->group(function () {
    Route::post('paypal', [FPaymentController::class, 'paypal_process'])->name('front.payment.paypal.process');
    Route::get('paypal/success', [FPaymentController::class, 'paypal_success'])->name('front.payment.paypal.success');
    Route::get('paypal/cancel', [FPaymentController::class, 'paypal_cancel'])->name('front.payment.paypal.cancel');
});
