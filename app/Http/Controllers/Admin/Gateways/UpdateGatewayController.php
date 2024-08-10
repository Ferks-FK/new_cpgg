<?php

namespace App\Http\Controllers\Admin\Gateways;

use App\Models\Gateway;
use Illuminate\Http\Request;

class UpdateGatewayController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $type)
    {
        $gateway = Gateway::where('type', $type)->firstOrFail();

        $rules = $gateway->getExtension($gateway->type)->rules();

        logger($request->all());

        if ($request->has('active')) {
            $active = $request->validate([
                'active' => 'required|boolean',
            ]);

            $gateway->update([
                'active' => $active['active'],
            ]);
        }

        // validate rules
        $data = $request->validate($rules);

        logger($data);

        $gateway->update([
            'data' => $data,
        ]);

        return response()->json([
            'message' => 'Gateway updated successfully.',
        ]);
    }
}
