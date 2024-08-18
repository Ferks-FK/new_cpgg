<?php

namespace App\Extensions;

use App\Models\Gateway;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;

/**
 * Most of the logic/code was taken from Azuriom (https://github.com/Azuriom/Azuriom)
 */
abstract class BasePaymentMethod
{
    /**
     * Payment method name.
     *
     * @var string
     */
    protected $name;

    /**
     * Payment method id.
     *
     * @var string
     */
    protected $id;

    /**
     * The associated gateway.
     */
    protected ?Gateway $gateway;

    /**
     * BasePaymentMethod constructor.
     *
     * @param Gateway|null $gateway
     */
    public function __construct(?Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Make a new payment request to the payment gateway.
     *
     * @return \Illuminate\Http\Response
     */
    abstract public function makePayment(Cart $cart, float $amount, string $currency);

    /**
     * Create a new pending payment for the given cart, associated with this payment method.
     */
    protected function createPayment(Cart $cart, float $price, string $currency, ?string $payment_id = null): Payment
    {
        $payment = Payment::create([
            'price' => $price,
            'currency' => $currency,
            'gateway_type' => $this->id,
            'status' => 'pending',
            'transaction_id' => $payment_id,
            'user_id' => auth()->user()->id
        ]);

        foreach($cart->items as $cart_item) {
            $payment_item = $payment->items()->make([
                'name' => $cart_item->product->name,
                'price' => $cart_item->product->price,
                'quantity' => $cart_item->quantity,
                'payment_id' => $payment->id
            ]);

            $payment_item->purchasable()->associate($cart_item->product);
            $payment_item->save();
        }

        return $payment;
    }

    /**
     * Try to process the given payment, and return a response with the result.
     * If a payment ID is provided, it will be used to update the payment transaction ID.
     */
    protected function processPayment(?Payment $payment, ?string $payment_id = null)
    {
        if (!$payment) {
            logger()->warning('Invalid payment for #' . $payment_id);

            return response()->json([
                'status' => false,
                'message' => 'Unable to retrieve the payment',
            ], 400);
        }

        if ($payment->isCompleted()) {
            return response()->json([
                'status' => true,
                'message' => 'Payment already completed',
            ]);
        }

        if (!$payment->isPending()) {
            logger()->warning("Invalid payment status for #{$payment->id}: ". $payment->status);

            return response()->json([
                'status' => false,
                'message' => 'Invalid payment status: '. $payment->status,
            ]);
        }

        if ($payment_id) {
            $payment->fill(['transaction_id' => $payment_id]);
        }

        $payment->deliver();

        return response()->json(['status' => true]);
    }

    /**
     * Handle a payment notification request sent by the payment gateway and return a response.
     *
     * @return \Illuminate\Http\Response
     */
    abstract public function notification(Request $request, ?string $payment_id);

    /**
     * Return the payment success response.
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        return to_route('shop')->with('success', 'Payment successful.');
    }

    /**
     * Return the payment failure response.
     *
     * @return \Illuminate\Http\Response
     */
    public function failure(Request $request)
    {
        return to_route('cart')->with('error', 'Payment failed.');
    }

    abstract public function rules(): array;
}
