<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Eloquent\StoreRepositoryInterface;
use App\Models\StoreProduct;

class StoreRepository extends EloquentConfigRepository implements StoreRepositoryInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = StoreProduct::query();
    }

    public function all(array $relations = [])
    {
        $relations = $this->getRelations($relations, 'storeProduct');

        $this->query->with($relations);

        return $this->query->get();
    }

    public function findById(int $id, array $relations = [])
    {
        $relations = $this->getRelations($relations, 'storeProduct');

        $this->query->with($relations);

        return $this->query->find($id);
    }

    public function create(array $data)
    {
        return $this->query->create($data);
    }

    public function update(array $data, int $id)
    {
        $model = $this->findById($id);

        $model->update($data);

        return $model;
    }

    public function delete(int $id)
    {
        return $this->findById($id)->delete();
    }
}
