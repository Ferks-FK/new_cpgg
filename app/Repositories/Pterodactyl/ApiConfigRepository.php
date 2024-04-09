<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\Pterodactyl\ApiConfigRepositoryInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ApiConfigRepository implements ApiConfigRepositoryInterface
{
    public function baseUrl(): string
    {
        $url = config('pterodactyl.url');

        if (!str_ends_with($url, '/')) {
            $url = $url . '/';
        }

        return $url;
    }

    public function clientToken(): string
    {
        return config('pterodactyl.user_token');
    }

    public function applicationToken(): string
    {
        return config('pterodactyl.admin_token');
    }

    public function client(): PendingRequest
    {
        return Http::withToken($this->clientToken())
            ->baseUrl($this->baseUrl() . 'client/');
    }

    public function application(): PendingRequest
    {
        return Http::withToken($this->applicationToken())
            ->baseUrl($this->baseUrl() . 'application/');
    }
}