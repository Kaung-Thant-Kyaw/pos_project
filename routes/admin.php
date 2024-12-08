<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\AdminController;


Route::group(['prefix' => 'admin'], function () {
    Route::get('/homepage', [AdminController::class, 'home'])->name('adminHome');
});
