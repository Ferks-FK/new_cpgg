<?php

use App\Http\Controllers\Admin\Store\CreateStoreController;
use App\Http\Controllers\Admin\Store\DeleteStoreProductsController;
use App\Http\Controllers\Admin\Store\EditStoreProductsController;
use App\Http\Controllers\Admin\Store\GetStoreProductsController;
use App\Http\Controllers\Admin\Store\StoreStoreProductsController;
use App\Http\Controllers\Admin\Store\UpdateStoreProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/store', GetStoreProductsController::class)->name('store');
Route::get('/store/edit/{id}', EditStoreProductsController::class)->name('store.edit');
Route::get('/store/create', CreateStoreController::class)->name('store.create');
Route::post('/store/store', StoreStoreProductsController::class)->name('store.store');
Route::patch('/store/update/{id}', UpdateStoreProductsController::class)->name('store.update');
Route::delete('/store/delete/{id}', DeleteStoreProductsController::class)->name('store.delete');