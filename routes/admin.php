<?php

use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\LicenseController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductReleaseController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebsettingController;
use App\Http\Controllers\Admin\WebmasterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnalyticsController::class, 'index'])->name('dashboards');

Route::prefix('analytics')->group(function () {
    Route::get('products/income', [AnalyticsController::class, 'product_income'])->name('analytics.product.income');
    Route::get('{url}/visitor', [AnalyticsController::class, 'visitor'])->name('analytics.visitor');
});

Route::prefix('categories')->group(function () {
    Route::get('/', function () {
        return redirect(url(config('app.admin_path')));
    });
    Route::get('json/{type}', [CategoryController::class, 'json'])->name('categories.json');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('destroyall', [CategoryController::class, 'destroyall'])->name('categories.destroyall');
    Route::get('{category:id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('{id}', [CategoryController::class, 'update'])->name('categories.update');
});

Route::prefix('tags')->group(function () {
    Route::get('/', function () {
        return redirect(url(config('app.admin_path')));
    });
    Route::get('json/{type}', [TagController::class, 'json'])->name('tags.json');
    Route::post('/', [TagController::class, 'store'])->name('tags.store');
    Route::get('{tag:id}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('{id}', [TagController::class, 'update'])->name('tags.update');
    Route::post('destroyall', [TagController::class, 'destroyall'])->name('tags.destroyall');
});

Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('json/{show}', [BlogController::class, 'json'])->name('blogs.json');
    Route::get('create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/', [BlogController::class, 'store'])->name('blogs.store');
    Route::post('destroyall', [BlogController::class, 'destroyall'])->name('blogs.destroyall');
    Route::get('{blog:id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::get('recovery/{id}', [BlogController::class, 'recovery'])->name('blogs.recovery');
    Route::get('trash', [BlogController::class, 'trash'])->name('blogs.trash');
    Route::post('forcedelete', [BlogController::class, 'forcedelete'])->name('blogs.forcedelete');
    Route::get('categories', [CategoryController::class, 'index'])->name('blogs.categories.index');
    Route::get('tags', [TagController::class, 'index'])->name('blogs.tags.index');
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::get('json/{show}', [ProductController::class, 'json'])->name('product.json');
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::get('{product:id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('destroyall', [ProductController::class, 'destroyall'])->name('product.destroyall');
    Route::get('recovery/{id}', [ProductController::class, 'recovery'])->name('product.recovery');
    Route::post('forcedelete', [ProductController::class, 'forcedelete'])->name('product.forcedelete');

    Route::get('docs/{product:id}', [ProductController::class, 'docs'])->name('product.docs');
    Route::put('docs/{id}', [ProductController::class, 'docs_update'])->name('product.docs.update');

    Route::get('categories', [CategoryController::class, 'index'])->name('product.categories.index');
    Route::get('tags', [TagController::class, 'index'])->name('product.tags.index');

    Route::get('images/{product:id}', [ProductController::class, 'images'])->name('product.images');
    Route::get('images-detail', [ProductController::class, 'images_detail'])->name('product.images.show');
    Route::post('images/{id}', [ProductController::class, 'images_store'])->name('product.images.store');
    Route::post('images-del', [ProductController::class, 'images_destroyall'])->name('product.images.destroyall');
});

Route::prefix('release')->group(function () {
    Route::get('{product:id}', [ProductReleaseController::class, 'index'])->name('release.index');
    Route::get('json/{id}', [ProductReleaseController::class, 'json'])->name('release.json');
    Route::post('/', [ProductReleaseController::class, 'store'])->name('release.store');
    Route::get('{id}/edit', [ProductReleaseController::class, 'edit'])->name('release.edit');
    Route::put('{id}', [ProductReleaseController::class, 'update'])->name('release.update');
    Route::post('destroyall', [ProductReleaseController::class, 'destroyall'])->name('release.destroyall');
});

Route::prefix('pages')->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('pages.index');
    Route::get('json', [PageController::class, 'json'])->name('pages.json');
    Route::get('create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/', [PageController::class, 'store'])->name('pages.store');
    Route::post('destroyall', [PageController::class, 'destroyall'])->name('pages.destroyall');
    Route::get('{page:id}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('{id}', [PageController::class, 'update'])->name('pages.update');
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('json/{show}', [UserController::class, 'json'])->name('users.json');
    Route::get('{user:id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('destroyall', [UserController::class, 'destroyall'])->name('users.destroyall');
    Route::get('remove/avatar/{user:id}', [UserController::class, 'removeavatar'])->name('users.remove.avatar');
    Route::get('recovery/{id}', [UserController::class, 'recovery'])->name('users.recovery');
    Route::get('trash', [UserController::class, 'trash'])->name('users.trash');
    Route::post('forcedelete', [UserController::class, 'forcedelete'])->name('users.forcedelete');
});

Route::prefix('license')->group(function () {
    Route::get('/', [LicenseController::class, 'index'])->name('license.index');
    Route::get('json', [LicenseController::class, 'json'])->name('license.json');
    Route::post('destroyall', [LicenseController::class, 'destroyall'])->name('license.destroyall');

    Route::prefix('product')->group(function () {
        Route::get('/', [LibraryController::class, 'index'])->name('product.license.index');
        Route::get('recovery', [LibraryController::class, 'trash'])->name('product.license.recovery');
        Route::get('recovery/{id}', [LibraryController::class, 'recovery'])->name('product.license.recoverys');
        Route::get('json/{show}/{username}/{product}', [LibraryController::class, 'json'])->name('product.license.json');
        Route::post('destroyall', [LibraryController::class, 'destroyall'])->name('product.license.destroyall');
        Route::post('forcedelete', [LibraryController::class, 'forcedelete'])->name('product.license.forcedelete');
    });
});

Route::prefix('payment')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('json', [PaymentController::class, 'json'])->name('payment.json');
    Route::post('destroyall', [PaymentController::class, 'destroyall'])->name('payment.destroyall');
});

Route::prefix('comments')->group(function () {
    Route::get('json', [CommentsController::class, 'json'])->name('comments.json');
    Route::get('show/{url}', [CommentsController::class, 'show'])->name('comments.show');
    Route::get('acc/{url}', [CommentsController::class, 'acc'])->name('comments.acc');
    Route::post('destroyall/{url}', [CommentsController::class, 'destroyall'])->name('comments.destroyall');
    Route::get('{url}', [CommentsController::class, 'index'])->name('comments.index');
});

Route::prefix('websetting')->group(function () {
    Route::get('/', [WebsettingController::class, 'index'])->name('websetting.index');
    Route::put('general', [WebsettingController::class, 'general_update'])->name('websetting.general.update');
    Route::put('style', [WebsettingController::class, 'style_update'])->name('websetting.style.update');
    Route::put('addons', [WebsettingController::class, 'addons_update'])->name('websetting.addons.update');
    Route::put('maintenance', [WebsettingController::class, 'maintenance_update'])->name('websetting.maintenance.update');
});

Route::prefix('webmaster')->group(function () {
    Route::get('/', [WebmasterController::class, 'index'])->name('webmaster.index');
    Route::put('/', [WebmasterController::class, 'general'])->name('webmaster.general');
    Route::put('smtp', [WebmasterController::class, 'smtp'])->name('webmaster.smtp');
    Route::put('payment', [WebmasterController::class, 'payment'])->name('webmaster.payment');
    Route::get('test/smtp', [WebmasterController::class, 'test_smtp'])->name('webmaster.test.smtp');
});

Route::prefix('files')->group(function () {
    Route::get('manager', [FileController::class, 'manager'])->name('files.manager');
    Route::get('tinymce5', [FileController::class, 'fortinymce'])->name('files.tinymce5');
});
