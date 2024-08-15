<?php

namespace App\Contracts;

interface LocationRepositoryInterface
{
    public function all(array $includes = []);

    public function findById(int $id, array $includes = []);
}
