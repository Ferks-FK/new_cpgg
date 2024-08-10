<?php

namespace App\Http\Controllers\Admin\Gateways;

use Illuminate\Http\Request;
use App\Contracts\Eloquent\GatewayRepositoryInterface;

class GetGatewaysController
{
    public function __construct(
        protected GatewayRepositoryInterface $gatewayRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $gateways = $this->gatewayRepositoryInterface->all();

        return view('modules.admin.gateways.index', compact('gateways'));
    }
}
