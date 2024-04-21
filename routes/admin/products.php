<?php

use App\Http\Controllers\Admin\Products\CreateProductController;
use App\Http\Controllers\Admin\Products\DeleteProductController;
use App\Http\Controllers\Admin\Products\EditProductController;
use App\Http\Controllers\Admin\Products\GetProductController;
use App\Http\Controllers\Admin\Products\StoreProductController;
use App\Http\Controllers\Admin\Products\UpdateProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', GetProductController::class)->name('products');
Route::get('/products/edit/{id}', EditProductController::class)->name('products.edit');
Route::get('/products/create', CreateProductController::class)->name('products.create');
Route::post('/products/store', StoreProductController::class)->name('products.store');
Route::patch('/products/update/{id}', UpdateProductController::class)->name('products.update');
Route::delete('/products/{id}', DeleteProductController::class)->name('products.delete');