<?php

use App\Http\Controllers\Cart\DeleteCartController;
use App\Http\Controllers\Cart\DeleteCartItemController;
use App\Http\Controllers\Cart\GetCartController;
use App\Http\Controllers\Cart\UpdateCartController;
use Illuminate\Support\Facades\Route;

Route::get('/cart', GetCartController::class)->name('cart');
Route::patch('/cart', UpdateCartController::class)->name('cart.update');
Route::delete('/cart/{id}', DeleteCartController::class)->name('cart.delete');
Route::delete('/cart/item/{id}', DeleteCartItemController::class)->name('cart.item.delete');
