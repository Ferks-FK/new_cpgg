<?php

use App\Http\Controllers\Checkout\FailedPaymentController;
use App\Http\Controllers\Checkout\GetCheckoutController;
use App\Http\Controllers\Checkout\PaymentController;
use App\Http\Controllers\Checkout\SuccessPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/checkout', GetCheckoutController::class)->name('checkout');
Route::get('/checkout/payments/{gateway:type}/success', SuccessPaymentController::class)->name('checkout.success');
Route::get('/checkout/payments/{gateway:type}/failed', FailedPaymentController::class)->name('checkout.failed');
Route::post('/checkout/{gateway:type}', PaymentController::class)->name('checkout.gateway');
