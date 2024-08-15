<?php

namespace App\Contracts;

interface ServerRepositoryInterface
{
    public function all(array $includes = []);

    public function findById(int $id, array $includes = []);

    public function create(mixed $data, mixed $egg_attributes, array $allocations, array $intall_variables);

    public function updateDetails(int $id, mixed $data);

    public function updateBuild(int $id, mixed $data);

    public function suspend(int $id);

    public function unsuspend(int $id);

    public function delete(int $id);
}
