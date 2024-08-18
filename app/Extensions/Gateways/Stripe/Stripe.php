<?php

namespace App\Extensions\Gateways\Stripe;

use App\Extensions\BasePaymentMethod;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Stripe as StripeClass;
use Stripe\Checkout\Session;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class Stripe extends BasePaymentMethod
{
    // https://docs.stripe.com/currencies#zero-decimal
    protected const ZERO_DECIMAL_CURRENCIES = [
        'BIF', 'CLP', 'DJF', 'GNF', 'JPY', 'KMF', 'KRW', 'MGA', 'PYG', 'RWF', 'VND', 'VUV', 'XAF', 'XOF', 'XPF',
    ];

    // https://docs.stripe.com/currencies#three-decimal
    protected const THREE_DECIMAL_CURRENCIES = [
        'BHD', 'JOD', 'KWD', 'OMR', 'TND',
    ];

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
        $this->setup();

        $items = $cart->items->map(function ($item) use($currency) {
            return [
                'price_data' => [
                    'currency' => $currency,
                    'unit_amount' => $this->convertAmount($item->product->price, $currency),
                    'product_data' => [
                        'name' => $item->product->name,
                        'description' => $item->product->description,
                    ],
                ],
                'quantity' => $item->quantity,
            ];
        });

        $payment = $this->createPayment($cart, $amount, $currency);

        $session = Session::create([
            'mode' => 'payment',
            'customer_email' => $payment->user->email,
            'line_items' => $items->toArray(),
            'success_url' => route('checkout.success', $this->id),
            'cancel_url' => route('cart'),
            'client_reference_id' => $payment->id,
        ]);

        $payment->update(['transaction_id' => $session->payment_intent]);

        return redirect()->away($session->url);
    }

    public function notification(Request $request, ?string $payment_id)
    {
        $this->setup();

        $webhook_secret = $this->gateway->data->webhook_secret;
        $stripe_signature = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($request->getContent(), $stripe_signature, $webhook_secret);
        } catch (SignatureVerificationException $e) {
            return response()->json([
                'error' => 'Invalid signature: '. $e->getMessage(),
            ], 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $payment = Payment::find($event->data->object->client_reference_id);

            $this->processPayment($payment);
        }
    }

    public function rules(): array
    {
        return [
            'public_key' => 'required|string',
            'secret_key' => 'required|string',
            'webhook_secret' => 'required|string'
        ];
    }

    /*
     * Adapt the currency to Stripe format. See https://stripe.com/docs/currencies
     */
    protected function convertAmount(float $amount, string $currency): int
    {
        if (in_array($currency, self::ZERO_DECIMAL_CURRENCIES, true)) {
            return $amount;
        }

        if (in_array($currency, self::THREE_DECIMAL_CURRENCIES, true)) {
            return $amount * 1000;
        }

        return $amount * 100;
    }

    /*
     * Retrieve decimal amount from Stripe format. See https://stripe.com/docs/currencies
     */
    protected function retrieveDecimalAmount(int $amount, string $currency): float
    {
        if (in_array($currency, self::ZERO_DECIMAL_CURRENCIES, true)) {
            return $amount;
        }

        if (in_array($currency, self::THREE_DECIMAL_CURRENCIES, true)) {
            return $amount / 1000;
        }

        return $amount / 100;
    }

    protected function setup(): void
    {
        StripeClass::setAppInfo('CtrlPanel');
        StripeClass::setLogger(logger()->driver());
        StripeClass::setApiKey($this->gateway->data->secret_key);
    }
}
