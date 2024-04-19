<?php

namespace App\Contracts;

interface EggRepositoryInterface
{
    public function all(array $includes = []);

    public function getEggAttributes(int $egg_id, array $includes = []);
}