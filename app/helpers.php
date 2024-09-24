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

if (!function_exists('setEnvironmentValue')) {
    function setEnvironmentValue($env_key, $env_value)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $str .= "\n";
        $keyPosition = strpos($str, "{$env_key}=");
        $endOfLinePosition = strpos($str, PHP_EOL, $keyPosition);
        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        $str = str_replace($oldLine, "{$env_key}={$env_value}", $str);
        $str = substr($str, 0, -1);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
}
