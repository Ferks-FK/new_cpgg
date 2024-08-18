<?php

namespace App\Repositories\Eloquent;

use App\Models\StoreCategory;
use App\Contracts\Eloquent\StoreCategoryRepositoryInterface;

class StoreCategoryRepository implements StoreCategoryRepositoryInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = StoreCategory::query();
    }

    public function all(array $relations = [])
    {
        $valid_relations = array_intersect($relations, $this->validRelations('products'));

        $this->query->with($valid_relations);

        return $this->query->get();
    }

    public function allActiveWithHasRelation(string $relation, array $relations = [])
    {
        $valid_relations = array_intersect($relations, $this->validRelations('products'));

        $this->query->with($valid_relations);

        return $this->query->activeWithHasRelation($relation)->get();
    }

    public function find(int $id, array $relations = [])
    {
        $valid_relations = array_intersect($relations, $this->validRelations('products'));

        $this->query->with($valid_relations);

        return $this->query->find($id);
    }

    private function validRelations(string $relation)
    {
        return match ($relation) {
            'products' => ['products'],
            default => [],
        };
    }
}
