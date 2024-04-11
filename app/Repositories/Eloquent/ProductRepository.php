<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Eloquent\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = Product::query();
    }

    public function get()
    {
        $result = $this->query->get();
        $this->query = Product::query();

        return $result;
    }

    public function all()
    {
        //
    }

    public function find(int $id)
    {
        //
    }

    public function findWhere(string $column, string $operator = '=')
    {
        $this->query->where($column, $operator);

        return $this;
    }

    public function create(array $data)
    {
        //
    }

    public function update(array $data, int $id)
    {
        //
    }

    public function delete(int $id)
    {
        //
    }
}