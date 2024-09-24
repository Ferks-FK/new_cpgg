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
}
