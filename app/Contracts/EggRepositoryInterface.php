<?php

namespace App\Contracts;

interface EggRepositoryInterface
{
    public function all();

    public function getEggs(?int $nestId = null);

    public function find(int $id);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}