<?php

namespace App\Extensions\Gateways\Stripe;

use App\Extensions\BasePaymentMethod;
use App\Models\Cart;
use Illuminate\Http\Request;

class Stripe extends BasePaymentMethod
{
    /**
     * The payment method id name.
     *
     * @var string
     */
    protected $id = 'stripe';

    /**
     * The payment method display name.
     *
     * @var string
     */
    protected $name = 'Stripe';

    public function makePayment(Cart $cart, float $amount, string $currency)
    {
        // Make a payment request to the Stripe payment gateway.
        logger([$amount, $currency]);
    }

    public function notification(Request $request, ?string $payment_id)
    {
        // Handle a payment notification request sent by the Stripe payment gateway.

        return response()->json([
            'message' => 'Payment notification received.',
            'json' => $request->all(),
        ]);
    }

    public function rules(): array
    {
        return [
            'public_key' => 'required|string',
            'secret_key' => 'required|string',
            'webhook_secret' => 'required|string'
        ];
    }
}
