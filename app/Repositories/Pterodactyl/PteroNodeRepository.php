<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\Pterodactyl\PteroNodeRepositoryInterface;
use Exception;

class PteroNodeRepository extends ApiConfigRepository implements PteroNodeRepositoryInterface
{
    public function all()
    {
        try {
            $response = $this->application()->get('nodes');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch nodes.');
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