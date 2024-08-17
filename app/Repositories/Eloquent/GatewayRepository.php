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

    public function findByType(string $type)
    {
        return $this->query->where('type', $type)->first();
    }

    public function update(string $type, array $data)
    {
        $model = $this->findByType($type);

        $model->update($data);

        return $model->fresh();
    }
}
