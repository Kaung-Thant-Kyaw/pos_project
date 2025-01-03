<?php

use App\Http\Controllers\Admins\PaymentController;
use App\Http\Controllers\Users\ProductController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
    Route::get('home', [UserController::class, 'home'])->name('userHome');

    Route::group(['prefix' => 'profile'], function () {
        // Edit Profile
        Route::get('/', [UserController::class, 'showProfile'])->name('user.profile');
        Route::get('edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
        Route::post('update/{id}', [UserController::class, 'updateProfile'])->name('user.profile.update');

        // change password
        Route::get('changePassword', [UserController::class, 'changePasswordPage'])->name('user.profile.changePasswordPage');
        Route::post('changePassword', [UserController::class, 'changePassword'])->name('user.profile.changePassword');
    });


    // Product
    Route::prefix('product')->group(function () {
        Route::get('detail/{id}', [ProductController::class, 'show'])->name('user.product.show');

        Route::post('addToCart', [ProductController::class, 'addToCart'])->name('user.product.addToCart');
        Route::get('cart', [ProductController::class, 'cart'])->name('user.product.cart');

        // api
        Route::get('cart/delete', [ProductController::class, 'cartDelete'])->name('user.product.cartDelete');
        Route::get('list', [ProductController::class, 'cartList'])->name('user.product.list');
    });

    // Payment Info
    Route::get('cart/temp', [ProductController::class, 'cartTemp'])->name('user.cartTemp');
    Route::get('payment', [ProductController::class, 'payment'])->name('user.payment');
    Route::post('order', [ProductController::class, 'order'])->name('user.order');
    Route::get('order/list', [ProductController::class, 'orderList'])->name('user.order.list');
});
