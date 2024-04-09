<?php

use App\Http\Controllers\Admin\Users\GetUsersController;
use Illuminate\Support\Facades\Route;

Route::get('/users', GetUsersController::class)->name('users');