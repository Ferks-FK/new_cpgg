<?php

namespace App\Http\Controllers\Cart;

use App\Contracts\Eloquent\CartRepositoryInterface;
use App\Http\Requests\Cart\UpdateCartRequest;

class UpdateCartController
{
    public function __construct(
        protected CartRepositoryInterface $cartRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateCartRequest $request)
    {
        $items = $this->cartRepositoryInterface->update($request->product_id, $request->quantity, $request->increment);

        return response()->json([
            'message' => 'Cart updated successfully.',
            'items' => $items
        ]);
    }
}
