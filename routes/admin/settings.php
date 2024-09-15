<?php

use App\Http\Controllers\Admin\Settings\GlobalSettingsController;
use App\Http\Controllers\Admin\Settings\PterodactylSettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/settings/global', GlobalSettingsController::class)->name('settings.global');
Route::patch('/settings/global/update', [GlobalSettingsController::class, 'update'])->name('settings.global.update');

Route::get('/settings/pterodactyl', PterodactylSettingsController::class)->name('settings.pterodactyl');
Route::patch('/settings/pterodactyl/update', [PterodactylSettingsController::class, 'update'])->name('settings.pterodactyl.update');
