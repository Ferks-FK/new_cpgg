<?php

use App\Http\Controllers\Checkout\GetCheckoutController;
use App\Http\Controllers\Checkout\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/checkout', GetCheckoutController::class)->name('checkout');
Route::post('/checkout/{gateway:type}', PaymentController::class)->name('checkout.gateway');
