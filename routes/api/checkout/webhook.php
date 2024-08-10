<?php

use App\Http\Controllers\Api\Checkout\WebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/webhook/{gateway:type}/{id?}', WebhookController::class)->name('webhook');
