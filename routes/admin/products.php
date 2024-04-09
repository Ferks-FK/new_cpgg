<?php

use App\Http\Controllers\Admin\Products\GetProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', GetProductController::class)->name('products');