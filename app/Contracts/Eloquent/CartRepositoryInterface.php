<?php

namespace App\Contracts\Eloquent;

interface CartRepositoryInterface
{
    public function get();

    public function update(int $product_id, int $quantity);

    public function delete(int $id);
}