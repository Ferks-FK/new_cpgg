<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Contracts\Eloquent\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $query;
    
    public function __construct()
    {
        $this->query = User::query();
    }

    public function all()
    {
        //
    }

    public function findById(int $id)
    {
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