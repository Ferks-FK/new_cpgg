<?php

namespace App\Contracts;

interface NodeRepositoryInterface
{
    public function all(array $includes = []);

    public function find(int $id);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}