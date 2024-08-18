<?php

namespace App\Http\Controllers\Checkout;

use App\Models\Gateway;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class GetCheckoutController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cart = Cart::where('session', Cookie::get('cart'))->first();

        abort_if((!$cart || $cart->items->count() === 0), 404);

        $gateways = Gateway::where('active', true)->get();

        if ($gateways->count() === 1) {
            $gateway = $gateways->first();

            $class = $gateway->getExtension(params: ['gateway' => $gateway]);

            return $class->makePayment($cart, $cart->total, 'USD');
        }

        return view('modules.checkout.index', compact('gateways'));
    }
}
