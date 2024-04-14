<?php

namespace App\Repositories\Pelican;

use App\Contracts\ServerRepositoryInterface;
use Exception;

class ServerRepository extends ApiConfigRepository implements ServerRepositoryInterface
{
    public function all(array $includes = [])
    {
        try {
            $response = $this->application()->get('servers?include=' . implode(',', $includes));
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch servers.');
        }

        return $response->json()['data'];
    }

    public function find(int $id)
    {

    }

    public function create(array $data)
    {

    }

    public function update(array $data, int $id)
    {

    }

    public function delete(int $id)
    {

    }
}