<?php

namespace App\Contracts\Eloquent;

interface UserRepositoryInterface
{
    public function all();

    public function findById(int $id);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}