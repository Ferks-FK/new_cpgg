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

    public function getAll()
    {
        return $this->query->get();
    }

    public function getActives()
    {
        return $this->query->where('active', true)->get();
    }

    public function findById(int $id)
    {
        return $this->query->find($id);
    }
}