<?php

use App\Http\Controllers\Admin\Servers\DeleteServerController;
use App\Http\Controllers\Admin\Servers\EditServerController;
use App\Http\Controllers\Admin\Servers\GetServersController;
use App\Http\Controllers\Admin\Servers\SuspendServerController;
use App\Http\Controllers\Admin\Servers\UnsuspendServerController;
use App\Http\Controllers\Admin\Servers\UpdateServerController;
use Illuminate\Support\Facades\Route;

Route::get('/servers', GetServersController::class)->name('servers');
Route::get('/servers/edit/{id}', EditServerController::class)->name('servers.edit');
Route::patch('/servers/update/{id}', UpdateServerController::class)->name('servers.update');
Route::post('/servers/suspend', SuspendServerController::class)->name('servers.suspend');
Route::post('/servers/unsuspend', UnsuspendServerController::class)->name('servers.unsuspend');
Route::delete('/servers/{id}', DeleteServerController::class)->name('servers.delete');