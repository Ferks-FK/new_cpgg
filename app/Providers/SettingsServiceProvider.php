<?php

namespace App\Providers;

use App\Models\Setting;
use App\Support\Settings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Exception;


class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Settings::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $repo = $this->app->make(Settings::class);

        try {
            $settings = $this->loadSettings();

            foreach ($settings as $name => $value) {
                $repo->set($name, $value);
            }
        } catch (Exception) {
            //
        }
    }

    protected function loadSettings(): array
    {
        return Cache::remember('settings', now()->addDay(), function () {
            return Setting::all()->pluck('value', 'name')->all();
        });
    }
}
