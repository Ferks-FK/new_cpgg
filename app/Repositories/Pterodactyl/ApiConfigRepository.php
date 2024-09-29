<?php

namespace App\Repositories\Pterodactyl;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ApiConfigRepository
{
    public function baseUrl(): string
    {
        return setting('panel_url');
    }

    public function token(): string
    {
        return setting('panel_api_key');
    }

    public function client(): PendingRequest
    {
        return Http::withToken($this->token())
            ->acceptJson()
            ->baseUrl($this->baseUrl() . '/client/');
    }

    public function application(): PendingRequest
    {
        return Http::withToken($this->token())
            ->acceptJson()
            ->baseUrl($this->baseUrl() . '/application/');
    }

    private function validFilters(string $endpoint)
    {
        return match ($endpoint) {
            'users' => ['email', 'uuid', 'username', 'external_id'],
            default => [],
        };
    }

    private function validIncludes(string $endpoint)
    {
        return match ($endpoint) {
            'nests' => ['eggs', 'eggs.variables', 'servers'],
            'nest-eggs' => ['nest', 'servers', 'config', 'script', 'variables'],
            'locations' => ['nodes', 'servers'],
            'nodes' => ['allocations', 'location', 'servers'],
            'node-allocations' => ['node', 'server'],
            'servers' => ['allocations', 'user', 'subusers', 'nest', 'egg', 'variables', 'location', 'node', 'databases'],
            'server-databases' => ['password', 'host'],
            default => [],
        };
    }

    protected function getFilters(array $filters, string $endpoint)
    {
        $valid_filters = array_intersect_key($filters, array_flip($this->validFilters($endpoint)));

        $filters = '';

        collect($valid_filters)->map(function ($value, $key) use (&$filters) {
            $separator = $filters ? '&' : '?';

            $value = is_array($value) ? implode(',', $value) : $value;

            $filters .= "{$separator}filter[{$key}]={$value}";
        });

        return $filters;
    }

    protected function getIncludes(array $includes, string $endpoint)
    {
        $valid_includes = array_intersect($includes, $this->validIncludes($endpoint));

        $includes = '';

        collect($valid_includes)->map(function ($value) use (&$includes) {
            $separator = $includes ? ',' : '?include=';

            $includes .= "{$separator}{$value}";
        });

        return $includes;
    }
}
