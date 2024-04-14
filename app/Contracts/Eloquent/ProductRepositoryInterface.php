<?php

namespace App\Contracts\Eloquent;

interface ProductRepositoryInterface
{
    public function getAll();

    public function getActives();

    public function findById(int $id);
}