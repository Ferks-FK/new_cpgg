<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Eloquent\ServerRepositoryInterface;
use App\Models\Server;

class ServerRepository implements ServerRepositoryInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = Server::query();
    }

    public function create(array $data)
    {
        return $this->query->create($data);
    }
}