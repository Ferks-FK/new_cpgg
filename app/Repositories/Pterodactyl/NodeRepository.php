<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\NodeRepositoryInterface;
use Exception;

class NodeRepository extends ApiConfigRepository implements NodeRepositoryInterface
{
    public function all(array $includes = [])
    {
        try {
            $response = $this->application()->get("locations?include=nodes," . implode(',', $includes));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch locations.');
        }

        return $response->json()['data'];
    }

    public function find(int $id)
    {
        //
    }

    public function create(array $data)
    {
        //
    }

    public function update(array $data, int $id)
    {
        //
    }

    public function delete(int $id)
    {
        //
    }
}