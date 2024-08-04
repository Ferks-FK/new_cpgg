<?php

namespace App\Contracts\Eloquent;

interface CartRepositoryInterface
{
    public function get(int $user_id, array $relations = []);

    public function update(int $product_id, int $quantity, bool $increment = true);

    public function delete(int $id);

    public function deleteItem(int $item_id);
}
