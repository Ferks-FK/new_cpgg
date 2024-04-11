<?php

use App\Http\Controllers\Servers\CreateServerController;
use App\Http\Controllers\Servers\GetNestEggsController;
use App\Http\Controllers\Servers\GetServersController;
use Illuminate\Support\Facades\Route;

Route::get('/servers', GetServersController::class)->name('servers');
Route::get('/servers/create', CreateServerController::class)->name('servers.create');
Route::get('/servers/nests/{nest}/eggs', GetNestEggsController::class)->name('servers.nests.eggs');