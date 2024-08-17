<?php

namespace App\Http\Controllers\Admin\Gateways;

use Illuminate\Http\Request;
use App\Contracts\Eloquent\GatewayRepositoryInterface;

class EditGatewayController
{
    public function __construct(
        protected GatewayRepositoryInterface $gatewayRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $type)
    {
        $gateway = $this->gatewayRepositoryInterface->findByType($type);

        $gateway->class = view("{$gateway->type}::admin.form")->render();

        return view('modules.admin.gateways.edit', compact('gateway'));
    }
}
