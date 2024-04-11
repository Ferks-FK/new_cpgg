<?php

namespace App\Contracts\Pterodactyl;

interface PteroNestRepositoryInterface
{
    public function all();

    public function getEggs(int $nestId);

    public function find(int $id);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}