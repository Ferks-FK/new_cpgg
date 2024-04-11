<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\Pterodactyl\PteroLocationRepositoryInterface;
use Exception;

class PteroLocationRepository extends ApiConfigRepository implements PteroLocationRepositoryInterface
{
    public function all(array $includes = [])
    {
        try {
            $response = $this->application()->get("locations?include=" . implode(',', $includes));
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