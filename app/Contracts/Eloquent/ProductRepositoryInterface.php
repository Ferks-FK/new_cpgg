<?php

namespace App\Contracts\Eloquent;

interface ProductRepositoryInterface
{
    public function get();

    public function all();

    public function find(int $id);

    public function findWhere(string $column, string $operator = '=');

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}