<?php

namespace App\Http\Controllers\Checkout;

use App\Models\Gateway;
use App\Contracts\Eloquent\GatewayRepositoryInterface;
use Illuminate\Http\Request;

class SuccessPaymentController
{
    public function __construct(
        protected GatewayRepositoryInterface $gatewayRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Gateway $gateway)
    {
        return $gateway->getExtension()->success($request);
    }
}
