<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Extensiable
{
    protected const GATEWAYS_NAMESPACE = 'App\\Extensions\\Gateways\\';

    public function getExtensions()
    {
        $extensions = collect();

        $this->scanDirectory(self::GATEWAYS_NAMESPACE, $extensions);

        return $extensions;
    }

    public function getExtension($name = null, $params = [])
    {
        $name = Str::studly($name ?: $this->type);

        $class = self::GATEWAYS_NAMESPACE . $name . '\\' . $name;

        return app($class, $params);
    }

    protected function scanDirectory($directory, $extensions)
    {
        $files = scandir($directory);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $filePath = $directory . DIRECTORY_SEPARATOR . $file;

            if (is_dir($filePath)) {
                $this->scanDirectory($filePath, $extensions);
            } else {
                $class = str_replace(DIRECTORY_SEPARATOR, '\\', $filePath);
                $class = Str::replaceLast('.php', '', $class);
                $extensions->push($class);
            }
        }
    }
}
