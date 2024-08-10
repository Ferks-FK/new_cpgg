<?php

use App\Http\Controllers\Admin\Gateways\GetGatewaysController;
use App\Http\Controllers\Admin\Gateways\EditGatewayController;
use App\Http\Controllers\Admin\Gateways\UpdateGatewayController;
use Illuminate\Support\Facades\Route;

Route::get('/gateways', GetGatewaysController::class)->name('gateways');
Route::get('/gateways/edit/{id}', EditGatewayController::class)->name('gateways.edit');
Route::patch('/gateways/update/{type}', UpdateGatewayController::class)->name('gateways.update');
