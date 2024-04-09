<?php

use App\Http\Controllers\Admin\Servers\GetServersController;
use Illuminate\Support\Facades\Route;

Route::get('/servers', GetServersController::class)->name('servers');