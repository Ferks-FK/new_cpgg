<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\Pterodactyl\PteroUserRepositoryInterface;
use Exception;

class PteroUserRepository extends ApiConfigRepository implements PteroUserRepositoryInterface
{
    public function all(array $includes = [])
    {
        //
    }

    public function find(int $id)
    {
        //
    }

    public function create(array $data)
    {
        try {
            $response = $this->application()->post('users', $data);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to create user.');
        }

        return $response->json();
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