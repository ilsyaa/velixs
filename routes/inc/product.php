<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FProductController;

Route::get('product', [FProductController::class, 'index'])->name('front.product.index');
Route::get('/item', [FProductController::class, 'category'])->name('front.product.category');
Route::get('item/{product:slug}', [FProductController::class, 'detail'])->name('front.product.detail');
