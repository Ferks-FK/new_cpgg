<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\UserRepositoryInterface;
use Exception;

class UserRepository extends ApiConfigRepository implements UserRepositoryInterface
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
        try {
            $response = $this->application()->patch("users/$id", $data);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to update user.');
        }

        return $response->json();
    }

    public function delete(int $id)
    {
        try {
            $response = $this->application()->delete("users/$id");
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to delete user.');
        }

        return $response->json();
    }
}
