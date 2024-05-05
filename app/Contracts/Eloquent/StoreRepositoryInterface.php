<?php

namespace App\Contracts\Eloquent;

interface StoreRepositoryInterface
{
    public function all(array $relations = []);

    public function findById(int $id, array $relations = []);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}