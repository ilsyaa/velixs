<?php

use App\Http\Controllers\Api\PrivateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('private')->group(function () {
    Route::post('whatsapp-verify', [PrivateController::class, 'whatsapp_verify']);
    Route::post('whatsapp-unverify', [PrivateController::class, 'whatsapp_unverify']);
    Route::post('notify', [PrivateController::class, 'notify']);
    // Route::get('create', [PrivateController::class, 'create']);
});
