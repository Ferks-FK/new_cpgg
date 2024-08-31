<?php

use App\Http\Controllers\Admin\Settings\GlobalSettingsController;
use App\Http\Controllers\Admin\Settings\PterodactylSettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/settings', GlobalSettingsController::class)->name('settings');
Route::patch('/settings/update', [GlobalSettingsController::class, 'update'])->name('settings.update');

Route::get('/settings/pterodactyl', PterodactylSettingsController::class)->name('settings.pterodactyl');
Route::patch('/settings/pterodactyl/update', [PterodactylSettingsController::class, 'update'])->name('settings.pterodactyl.update');
