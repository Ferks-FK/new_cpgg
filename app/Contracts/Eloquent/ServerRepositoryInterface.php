<?php

namespace App\Contracts\Eloquent;

interface ServerRepositoryInterface
{
    public function all(array $relations = []);

    public function allActives(array $relations = []);

    public function create(array $data);

    public function findById(int $id, array $relations = []);

    public function update(int $id, array $data);

    public function delete(int $id);
}
