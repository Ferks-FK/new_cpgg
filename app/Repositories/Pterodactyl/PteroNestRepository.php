<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\Pterodactyl\PteroNestRepositoryInterface;
use Exception;

class PteroNestRepository extends ApiConfigRepository implements PteroNestRepositoryInterface
{
    public function all()
    {
        try {
            $response = $this->application()->get('nests');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch nests.');
        }

        return $response->json()['data'];
    }

    public function getEggs(int $nestId)
    {
        try {
            $response = $this->application()->get("nests/$nestId/eggs");
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch eggs.');
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