<?php

use App\Http\Controllers\Servers\CreateServerController;
use App\Http\Controllers\Servers\GetNestEggsController;
use App\Http\Controllers\Servers\GetServersController;
use App\Http\Controllers\Servers\StoreServerController;
use Illuminate\Support\Facades\Route;

Route::get('/servers', GetServersController::class)->name('servers');
Route::get('/servers/create', CreateServerController::class)->name('servers.create');
Route::get('/servers/nests/{nest}/eggs', GetNestEggsController::class)->name('servers.nests.eggs');
Route::post('/servers/store', StoreServerController::class)->name('servers.store');