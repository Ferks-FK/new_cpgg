<?php

namespace App\Contracts\Eloquent;

interface StoreCategoryRepositoryInterface
{
    public function all(array $relations = []);

    public function allActiveWithHasRelation(string $relation, array $relations = []);

    public function find(int $id, array $relations = []);
}
