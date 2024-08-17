<?php

namespace App\Http\Controllers\Admin\Gateways;

use App\Contracts\Eloquent\GatewayRepositoryInterface;
use Illuminate\Http\Request;

class UpdateGatewayController
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

        $rules = $gateway->getExtension()->rules();

        if ($request->has('active')) {
            $active = $request->validate([
                'active' => 'required|boolean',
            ]);

            $gateway->update([
                'active' => $active['active'],
            ]);
        }

        // validate rules of gateway.
        $data = $request->validate($rules);

        $this->gatewayRepositoryInterface->update($gateway->type, [
            'data' => $data,
        ]);

        return response()->json([
            'message' => 'Gateway updated successfully.',
        ]);
    }
}
