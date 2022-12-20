<?php

use App\Http\Controllers\Front\FBlogController;
use Illuminate\Support\Facades\Route;

Route::get('articles', [FBlogController::class, 'index'])->name('front.article.index');
Route::get('article/{blog:slug}', [FBlogController::class, 'detail'])->name('front.article.detail');

Route::get('tutorial', [FBlogController::class, 'index'])->name('front.tutorial.index');
Route::get('topics/{category}', [FBlogController::class, 'index'])->name('front.topics.index');
Route::get('tutorial/{blog:slug}', [FBlogController::class, 'detail'])->name('front.tutorial.detail');
