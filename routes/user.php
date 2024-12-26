<?php

use App\Http\Controllers\Users\ProductController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
    Route::get('home', [UserController::class, 'home'])->name('userHome');

    // Product
    Route::prefix('product')->group(function () {
        Route::get('detail/{id}', [ProductController::class, 'show'])->name('user.product.show');

        Route::post('addToCart', [ProductController::class, 'addToCart'])->name('user.product.addToCart');
        Route::get('cart', [ProductController::class, 'cart'])->name('user.product.cart');
    });
});
