<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\CategoryController;

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/homepage', [AdminController::class, 'home'])->name('adminHome');

    // Category
    Route::group(['prefix' => 'category'], function () {
        Route::get('list', [CategoryController::class, 'list'])->name('category#list');
    });
});
