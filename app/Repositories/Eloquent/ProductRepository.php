<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Eloquent\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository extends EloquentConfigRepository implements ProductRepositoryInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = Product::query();
    }

    public function getAll(array $relations = [])
    {
        $relations = $this->getRelations($relations, 'product');

        $this->query->with($relations);

        return $this->query->get();
    }

    public function getActives()
    {
        return $this->query->where('active', true)->get();
    }

    public function findById(int $id, array $relations = [])
    {
        $relations = $this->getRelations($relations, 'product');

        $this->query->with($relations);

        return $this->query->find($id);
    }

    public function create(array $data)
    {
        return $this->query->create($data);
    }

    public function update(int $id, array $data)
    {
        $model = $this->findById($id);

        $model->update($data);

        return $model->fresh();
    }

    public function delete(int $id)
    {
        return $this->query->find($id)->delete();
    }
}
