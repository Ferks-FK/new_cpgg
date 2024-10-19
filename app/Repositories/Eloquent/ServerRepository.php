<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Eloquent\ServerRepositoryInterface;
use App\Models\Server;

class ServerRepository extends EloquentConfigRepository implements ServerRepositoryInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = Server::query();
    }

    public function all(array $relations = [])
    {
        $relations = $this->getRelations($relations, 'server');

        $this->query->with($relations);

        return $this->query->get();
    }

    public function allActives(array $relations = [])
    {
        $relations = $this->getRelations($relations, 'server');

        $this->query->with($relations);

        return $this->query->where('suspended', false)->get();
    }

    public function create(array $data)
    {
        return $this->query->create($data);
    }

    public function findById(int $id, array $relations = [])
    {
        $relations = $this->getRelations($relations, 'server');

        $this->query->with($relations);

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
}
