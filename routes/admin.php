<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Admins\ProfileController;

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

        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('update', [ProfileController::class, 'update'])->name('profile.update');
    });
});
