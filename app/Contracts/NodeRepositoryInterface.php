<?php

namespace App\Contracts;

interface NodeRepositoryInterface
{
    public function all(array $includes = []);

    public function getFreeAllocations(int $nodeId);
}