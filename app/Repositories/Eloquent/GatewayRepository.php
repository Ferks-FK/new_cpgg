<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Eloquent\GatewayRepositoryInterface;
use App\Models\Gateway;

class GatewayRepository implements GatewayRepositoryInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = Gateway::query();
    }

    public function all()
    {
        return $this->query->get();
    }

    public function update()
    {
        // Update gateway
    }
}
