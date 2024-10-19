<?php

namespace App\Repositories\Eloquent;

use App\Models\StoreCategory;
use App\Contracts\Eloquent\StoreCategoryRepositoryInterface;

class StoreCategoryRepository extends EloquentConfigRepository implements StoreCategoryRepositoryInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = StoreCategory::query();
    }

    public function all(array $relations = [])
    {
        $relations = $this->getRelations($relations, 'storeCategory');

        $this->query->with($relations);

        return $this->query->get();
    }

    public function allActiveWithHasRelation(string $relation, array $relations = [])
    {
        $relations = $this->getRelations($relations, 'storeCategory');

        $this->query->with($relations);

        return $this->query->activeWithHasRelation($relation)->get();
    }

    public function find(int $id, array $relations = [])
    {
        $relations = $this->getRelations($relations, 'storeCategory');

        $this->query->with($relations);

        return $this->query->find($id);
    }
}
