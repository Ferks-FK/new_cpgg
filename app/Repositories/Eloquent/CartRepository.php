<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Eloquent\CartRepositoryInterface;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartRepository implements CartRepositoryInterface
{
    protected $query;
    public $session;
    public $cart;

    public function __construct()
    {
        $this->query = Cart::query();
        $this->session = Cookie::get('cart') ?? Str::uuid();

        if (!Cookie::has('cart')) {
            Cookie::queue('cart', $this->session, 60 * 24 * 30);
        }

        $this->cart = Cart::where('session', $this->session)->first();
    }

    public function get(int $user_id, array $relations = [])
    {
        $valid_relations = array_intersect($relations, $this->validRelations('cart'));

        $this->query->with($valid_relations);

        return $this->query->where('user_id', $user_id)->first();
    }

    public function update(int $product_id, int $quantity, bool $increment = true)
    {
        if (!$this->cart) {
            $this->createCart();
        }

        $item = $this->cart->items()->where([
            ['store_product_id', '=', $product_id],
            ['cart_id', '=', $this->cart->id]
        ])->firstOr(function () use ($product_id) {
            return $this->cart->items()->create([
                'store_product_id' => $product_id,
                'quantity' => 0
            ]);
        });

        if ($increment) {
            $item->quantity = $item->quantity + $quantity;
        } else {
            $item->quantity = $quantity;
        }

        $item->save();

        return $this->cart->items;
    }

    public function delete(int $id)
    {
        return $this->query->find($id)->delete();
    }

    public function deleteItem(int $item_id)
    {
        if (!$this->cart) {
            return;
        }

        $this->cart->items()->where([
            ['id', '=', $item_id],
            ['cart_id', '=', $this->cart->id]
        ])->delete();

        if ($this->cart->items->isEmpty()) {
            $this->cart->delete();
            $this->cart = null;
        }

        return $this->cart;
    }

    private function createCart()
    {
        $this->cart = Cart::create([
            'session' => $this->session,
            'user_id' => auth()->id()
        ]);
    }

    private function validRelations(string $relation)
    {
        return match ($relation) {
            'cart' => ['items', 'items.product'],
            default => [],
        };
    }
}
