<?php

use App\Http\Controllers\Shop\GetCategoryController;
use App\Http\Controllers\Shop\GetShopController;
use Illuminate\Support\Facades\Route;

Route::get('/shop', GetShopController::class)->name('shop');
Route::get('/shop/category/{id}', GetCategoryController::class)->name('shop.category');