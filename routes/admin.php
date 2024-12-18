<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\PaymentController;
use App\Http\Controllers\Admins\ProfileController;
use App\Http\Controllers\ProductController;

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/homepage', [AdminController::class, 'home'])->name('adminHome');

    // Category
    Route::group(['prefix' => 'category'], function () {
        Route::get('list', [CategoryController::class, 'list'])->name('categories.list');
        Route::post('create', [CategoryController::class, 'create'])->name('categories.create');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // Profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('changePassword', [ProfileController::class, 'changePasswordPage'])->name('profile.changePassword.page');
        Route::post('changePassword', [ProfileController::class, 'changePassword'])->name('profile.changePassword');

        Route::get('/', [ProfileController::class, 'show'])->name('adminProfile.show');
        Route::get('edit', [ProfileController::class, 'edit'])->name('adminProfile.edit');
        Route::post('update', [ProfileController::class, 'update'])->name('adminProfile.update');

        Route::group(['middleware' => 'superadmin'], function () {
            Route::get('add/newAdmin', [ProfileController::class, 'create'])->name('addAdmin.create');
            Route::post('add/newAdmin', [ProfileController::class, 'store'])->name('addAdmin.store');
            Route::get('admin/list', [ProfileController::class, 'adminList'])->name('admin.list');
            Route::get('delete/admin/{id}', [ProfileController::class, 'destroy'])->name('admin.destroy');
            Route::group(['prefix' => 'user'], function () {
                Route::get('list', [ProfileController::class, 'userList'])->name('user.list'); // Display user list
                Route::get('delete/{id}', [ProfileController::class, 'destroyUser'])->name('user.destroy'); // Delete a user
            });
        });
    });

    // Product
    Route::group(['prefix' => 'product'], function () {
        Route::get('list', [ProductController::class, 'list'])->name('products.list');
        Route::get('create', [ProductController::class, 'create'])->name('products.create');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // Payment
    Route::group(['prefix' => 'payment', 'middleware' => 'superadmin'], function () {
        Route::get('/', [PaymentController::class, 'index'])->name('payment.index');
        Route::post('/store', [PaymentController::class, 'store'])->name('payment.store');
        Route::get('/edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
        Route::post('/update/{id}', [PaymentController::class, 'update'])->name('payment.update');
        Route::get('/delete/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');
    });
});
