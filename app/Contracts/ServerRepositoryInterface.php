<?php

namespace App\Contracts;

interface ServerRepositoryInterface
{
    public function all(array $includes = []);

    public function findById(int $id, array $includes = []);

    public function create(mixed $data, mixed $egg_attributes, array $allocations);

    public function delete(int $id);
}