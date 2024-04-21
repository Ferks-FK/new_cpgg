<?php

namespace App\Contracts\Eloquent;

interface ProductRepositoryInterface
{
    public function getAll(array $relations = []);

    public function getActives();

    public function findById(int $id, array $relations = []);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}