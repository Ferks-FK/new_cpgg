<?php

namespace App\Http\Controllers\Cart;

use App\Contracts\Eloquent\CartRepositoryInterface;
use Illuminate\Http\Request;

class GetCartController
{
    public function __construct(
        protected CartRepositoryInterface $cart)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cart = $this->cart->get($request->user()->id, ['items', 'items.product']);

        return view('modules.cart.index', compact('cart'));
    }
}
