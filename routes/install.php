<?php

use App\Http\Controllers\Install\GetInstallerAccountController;
use App\Http\Controllers\Install\GetInstallerDatabaseController;
use App\Http\Controllers\Install\GetInstallerEnviromentController;
use App\Http\Controllers\Install\GetInstallerRequirementsController;
use Illuminate\Support\Facades\Route;

Route::get('/install/requirements', GetInstallerRequirementsController::class)->name('install');

Route::get('/install/database', GetInstallerDatabaseController::class)->name('install.database');
Route::post('/install/database', [GetInstallerDatabaseController::class, 'store'])->name('install.database');

Route::get('/install/enviroment', GetInstallerEnviromentController::class)->name('install.enviroment');
Route::post('/install/enviroment', [GetInstallerEnviromentController::class, 'store'])->name('install.enviroment');

Route::get('/install/account', GetInstallerAccountController::class)->name('install.account');
Route::post('/install/account', [GetInstallerAccountController::class, 'store'])->name('install.account');
