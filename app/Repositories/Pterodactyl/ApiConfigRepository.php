<?php

namespace App\Repositories\Pterodactyl;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ApiConfigRepository
{
    public function baseUrl(): string
    {
        $url = setting('pterodactyl_api_url');

        return $url;
    }

    public function clientToken(): string
    {
        return setting('pterodactyl_api_user_key');
    }

    public function applicationToken(): string
    {
        return setting('pterodactyl_api_admin_key');
    }

    public function client(): PendingRequest
    {
        return Http::withToken($this->clientToken())
            ->baseUrl($this->baseUrl() . '/client/');
    }

    public function application(): PendingRequest
    {
        return Http::withToken($this->applicationToken())
            ->baseUrl($this->baseUrl() . '/application/');
    }
}
