<?php

namespace App\Http\Controllers\Admin\Servers;

use App\Repositories\Pterodactyl\ServerRepository;
use App\Models\Server;
use Illuminate\Http\Request;

class GetServersController
{
    protected $serverRepository;

    public function __construct(ServerRepository $serverRepository)
    {
        $this->serverRepository = $serverRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $servers = $this->serverRepository->all(
        //     includes: ['user']
        // );

        $servers = Server::with(['product', 'user'])->get();

        return view('modules.admin.servers.index', compact('servers'));
    }
}
