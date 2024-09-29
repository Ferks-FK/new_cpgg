<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\UserRepositoryInterface;
use App\Exceptions\Repositories\Pterodactyl\ValidationException;
use Exception;

class UserRepository extends ApiConfigRepository implements UserRepositoryInterface
{
    public function all(array $includes = [])
    {
        //
    }

    public function find(array $filters = [])
    {
        $filters = $this->getFilters($filters, 'users');

        try {
            $response = $this->application()->get('users' . $filters);

            if ($response->failed()) {
                throw new Exception('Failed to find user.');
            }

            return $response->json();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function create(array $data)
    {
        try {
            $response = $this->application()->post('users', $data);

            if ($response->failed()) {
                $fields = [
                    'username' => 'first_name'
                ];

                throw new ValidationException($response->json('errors'), $fields);
            }

            return $response->json();
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function update(array $data, int $id)
    {
        try {
            $response = $this->application()->patch("users/$id", $data);

            if ($response->failed()) {
                $fields = [
                    'username' => 'first_name'
                ];

                throw new ValidationException($response->json('errors'), $fields);
            }
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
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
