<?php

namespace App\Repositories\Eloquent;

class EloquentConfigRepository
{
    protected function getRelations(array $relations, string $relation): array
    {
        $valid_relations = array_intersect($relations, $this->validRelations($relation));

        return $valid_relations;
    }

    private function validRelations(string $relation)
    {
        return match ($relation) {
            'cart' => ['items', 'items.product'],
            'product' => ['servers'],
            'server' => ['product', 'user'],
            'storeCategory' => ['products'],
            'storeProduct' => ['category'],
            'user' => ['servers', 'servers.product'],
            default => [],
        };
    }
}
