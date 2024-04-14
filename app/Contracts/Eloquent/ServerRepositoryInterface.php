<?php

namespace App\Contracts\Eloquent;

interface ServerRepositoryInterface
{
    public function create(array $data);
}