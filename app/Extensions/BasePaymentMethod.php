<?php

namespace App\Extensions;

use App\Models\Gateway;
use App\Models\Cart;
use Illuminate\Http\Request;

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
     * Handle a payment notification request sent by the payment gateway and return a response.
     *
     * @return \Illuminate\Http\Response
     */
    abstract public function notification(Request $request, ?string $payment_id);

    abstract public function rules(): array;
}
