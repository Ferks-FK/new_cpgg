<?php

namespace App\Contracts;

interface EggRepositoryInterface
{
    public function all();

    public function getEggs(?int $nestId = null);
}