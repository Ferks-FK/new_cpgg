<?php

namespace App\Http\Controllers\Servers;

use App\Contracts\ServerRepositoryInterface;
use App\Contracts\Eloquent\UserRepositoryInterface;
use Illuminate\Http\Request;

class GetServersController
{
    public function __construct(
        protected ServerRepositoryInterface $serverRepositoryInterface,
        protected UserRepositoryInterface $userRepositoryInterface)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $servers = $this->userRepositoryInterface->find(auth()->id())->servers->map(function ($server) {
            $server->load('product');

            $pterodactyl_server = $this->serverRepositoryInterface->findById($server->pterodactyl_server_id,
                ['location', 'node', 'nest', 'egg']
            );

            return array_merge($server->toArray(), [
                'node' => $pterodactyl_server['relationships']['node']['attributes']['name'],
                'location' => $pterodactyl_server['relationships']['location']['attributes']['long'],
                'nest' => $pterodactyl_server['relationships']['nest']['attributes']['name'],
                'egg' => $pterodactyl_server['relationships']['egg']['attributes']['name'],
            ]);
        });

        //dd($servers);

        return view('modules.servers.index', compact('servers'));
    }
}
