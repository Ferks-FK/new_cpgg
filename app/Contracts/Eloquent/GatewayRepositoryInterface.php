<?php

namespace App\Contracts\Eloquent;

interface GatewayRepositoryInterface
{
    public function all();

    public function findByType(string $type);

    public function update(string $type, array $data);
}
