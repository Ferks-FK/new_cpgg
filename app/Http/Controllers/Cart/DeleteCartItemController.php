<?php

namespace App\Http\Controllers\Cart;

use App\Contracts\Eloquent\CartRepositoryInterface;
use Illuminate\Http\Request;

class DeleteCartItemController
{
    public function __construct(
        protected CartRepositoryInterface $cartRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $item_id)
    {
        $cart = $this->cartRepositoryInterface->deleteItem($item_id);

        return response()->json([
            'message' => 'Cart item deleted successfully.',
            'cart' => $cart
        ]);
    }
}
