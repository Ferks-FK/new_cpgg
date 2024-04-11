<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Contracts\Eloquent\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        //
    }

    public function find(int $id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, int $id)
    {
        //
    }

    public function delete(int $id)
    {
        //
    }
}