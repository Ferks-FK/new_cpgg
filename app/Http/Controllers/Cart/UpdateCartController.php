<?php

namespace App\Http\Controllers\Cart;

use App\Contracts\Eloquent\CartRepositoryInterface;
use Illuminate\Http\Request;

class UpdateCartController
{
    public function __construct(
        protected CartRepositoryInterface $cartRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $items = $this->cartRepositoryInterface->update($request->product_id, $request->quantity);

        return response()->json([
            'message' => 'Cart updated successfully.',
            'items' => $items
        ]);
    }
}
