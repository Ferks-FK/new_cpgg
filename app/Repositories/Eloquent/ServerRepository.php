<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Eloquent\ServerRepositoryInterface;
use App\Models\Server;

class ServerRepository implements ServerRepositoryInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = Server::query();
    }

    public function all(array $relations = [])
    {
        $valid_relations = array_intersect($relations, $this->validRelations('server'));

        $this->query->with($valid_relations);

        return $this->query->get();
    }

    public function create(array $data)
    {
        return $this->query->create($data);
    }

    public function findById(int $id, array $relations = [])
    {
        $valid_relations = array_intersect($relations, $this->validRelations('server'));

        $this->query->with($valid_relations);

        return $this->query->find($id);
    }

    public function update(int $id, array $data)
    {
        $model = $this->findById($id);

        $model->update($data);

        return $model->fresh();
    }

    public function delete(int $id)
    {
        $model = $this->findById($id);

        $model->delete();

        return $model;
    }

    private function validRelations(string $relation)
    {
        return match ($relation) {
            'server' => ['product', 'user'],
            default => [],
        };
    }
}