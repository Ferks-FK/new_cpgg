<?php

use App\Http\Controllers\Cart\DeleteCartController;
use App\Http\Controllers\Cart\GetCartController;
use App\Http\Controllers\Cart\UpdateCartController;
use Illuminate\Support\Facades\Route;

Route::get('/cart', GetCartController::class)->name('cart');
Route::patch('/cart', UpdateCartController::class)->name('cart.update');
Route::delete('/cart', DeleteCartController::class)->name('cart.delete');