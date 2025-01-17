<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Contracts\Eloquent\UserRepositoryInterface;
class UserRepository extends EloquentConfigRepository implements UserRepositoryInterface
{
    protected $query;

    public function __construct()
    {
        $this->query = User::query();
    }

    public function all(array $relations = [])
    {
        $relations = $this->getRelations($relations, 'user');

        $this->query->with($relations);

        return $this->query->get();
    }

    public function findById(int $id, array $relations = [])
    {
        $relations = $this->getRelations($relations, 'user');

        $this->query->with($relations);

        return $this->query->find($id);
    }

    public function create(array $data)
    {
        return $this->query->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->findById($id)->update($data);
    }

    public function delete(int $id)
    {
        //
    }
}
