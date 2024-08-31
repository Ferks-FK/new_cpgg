<?php

namespace App\Support;

use Illuminate\Support\Collection;

class Settings
{
    protected Collection $settings;

    public function __construct(?Collection $settings = null)
    {
        $this->settings = $settings ?? collect();
    }

    /**
     * Check if the settings collection has a key.
     *
     * @param string $key
     * @return boolean
     */
    public function has(string $key): bool
    {
        return $this->settings->has($key);
    }

    /**
     * Get a setting from the collection.
     *
     * @param string|null $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(?string $key, mixed $default = null): mixed
    {
        return $this->settings->get($key, $default);
    }

    /**
     * Set a setting in the collection.
     *
     * @param array|string $key
     * @param mixed $value
     * @return void
     */
    public function set(array|string $key, $value): void
    {
        $keys = is_array($key) ? $key : [$key => $value];

        $this->settings = $this->settings->merge($keys);
    }
}
