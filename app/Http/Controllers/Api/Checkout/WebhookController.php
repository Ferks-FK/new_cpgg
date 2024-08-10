<?php

namespace App\Http\Controllers\Api\Checkout;

use Illuminate\Http\Request;
use App\Models\Gateway;

class WebhookController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Gateway $gateway, ?string $id = null)
    {
        $class = $gateway->getExtension($gateway->type, ['gateway' => $gateway]);

        return $class->notification($request, $id);
    }
}
