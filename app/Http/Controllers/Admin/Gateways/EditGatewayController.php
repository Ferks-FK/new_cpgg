<?php

namespace App\Http\Controllers\Admin\Gateways;

use App\Models\Gateway;
use Illuminate\Http\Request;

class EditGatewayController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id)
    {
        $gateway = Gateway::findOrFail($id);

        $gateway->class = view("{$gateway->type}::admin.form")->render();

        return view('modules.admin.gateways.edit', compact('gateway'));
    }
}
