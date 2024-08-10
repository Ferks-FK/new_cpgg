<?php

namespace App\Http\Controllers\Checkout;

use App\Models\Cart;
use App\Models\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PaymentController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Gateway $gateway)
    {
        $cart = Cart::where('session', Cookie::get('cart'))->first();

        $class = $gateway->getExtension($gateway->type, ['gateway' => $gateway]);

        $class->makePayment($cart, 100, 'USD');
    }
}
