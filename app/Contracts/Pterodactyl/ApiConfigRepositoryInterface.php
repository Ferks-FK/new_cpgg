<?php

namespace App\Contracts\Pterodactyl;

use Illuminate\Http\Client\PendingRequest;

interface ApiConfigRepositoryInterface
{
    public function baseUrl(): string;

    public function clientToken(): string;

    public function applicationToken(): string;

    public function client(): PendingRequest;

    public function application(): PendingRequest;
}