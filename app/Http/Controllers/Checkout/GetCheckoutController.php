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
        $gateways = Gateway::where('active', true)->get();

        if ($gateways->count() === 1) {
            $cart = Cart::where('session', Cookie::get('cart'))->first();

            $gateway = $gateways->first();

            $class = $gateway->getExtension($gateway->type, ['gateway' => $gateway]);

            return $class->makePayment($cart, 100, 'USD');
        }

        return view('modules.checkout.index', compact('gateways'));
    }
}
