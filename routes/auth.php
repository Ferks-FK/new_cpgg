<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::view('/login', 'auth.login')->name('login.view');
    Route::view('/register', 'auth.register')->name('register.view');
    Route::get('/logout', LogoutController::class)->withoutMiddleware('guest')->name('logout');
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/register', RegisterController::class)->name('register');
});
