<?php

use App\Http\Controllers\Admin\Users\DeleteUserController;
use App\Http\Controllers\Admin\Users\EditUserController;
use App\Http\Controllers\Admin\Users\GetUsersController;
use App\Http\Controllers\Admin\Users\StoreUserController;
use App\Http\Controllers\Admin\Users\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', GetUsersController::class)->name('users');
Route::get('/users/edit/{id}', EditUserController::class)->name('users.edit');
Route::view('/users/create', 'modules.admin.users.create')->name('users.create');
Route::post('/users/store', StoreUserController::class)->name('users.store');
Route::patch('/users/update/{id}', UpdateUserController::class)->name('users.update');
Route::delete('/users/{id}', DeleteUserController::class)->name('users.delete');