<?php

use App\Http\Controllers\Admin\Users\DeleteUserController;
use App\Http\Controllers\Admin\Users\GetUsersController;
use Illuminate\Support\Facades\Route;

Route::get('/users', GetUsersController::class)->name('users');
Route::delete('/users/{id}', DeleteUserController::class)->name('users.delete');