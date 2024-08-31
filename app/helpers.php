<?php

use App\Support\Settings;

if (!function_exists('setting')) {
    function setting(?string $key = null, mixed $default = null)
    {
        $settings = app(Settings::class);

        if (!$key) {
            return $settings;
        }

        return $settings->get($key, $default);
    }
}
