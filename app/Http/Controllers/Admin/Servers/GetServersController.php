<?php

namespace App\Http\Controllers\Admin\Servers;

use App\Contracts\Eloquent\ServerRepositoryInterface;
use Illuminate\Http\Request;

class GetServersController
{
    public function __construct(
        protected ServerRepositoryInterface $serverRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $servers = $this->serverRepositoryInterface->all(
            relations: ['product', 'user']
        );

        return view('modules.admin.servers.index', compact('servers'));
    }
}
