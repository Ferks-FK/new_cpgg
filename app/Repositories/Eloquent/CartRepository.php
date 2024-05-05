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

        $this->cart = Cart::firstOrCreate(
            ['session' => $this->session],
            ['session' => $this->session]
        );
    }

    public function get()
    {
        return $this->query->get();
    }

    public function update(int $product_id, int $quantity)
    {
        $item = $this->cart->items()->where([
            ['store_product_id', '=', $product_id],
            ['cart_id', '=', $this->cart->id]
        ])->firstOr(function () use ($product_id) {
            return $this->cart->items()->create([
                'store_product_id' => $product_id,
                'quantity' => 0
            ]);
        });

        $item->quantity = $item->quantity + $quantity;
        $item->save();

        return $this->cart->items;
    }

    public function delete(int $id)
    {
        return $this->query->find($id)->delete();
    }
}