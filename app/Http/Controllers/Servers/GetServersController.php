<?php

namespace App\Http\Controllers\Servers;

use App\Contracts\ServerRepositoryInterface;
use App\Contracts\Eloquent\UserRepositoryInterface;
use App\Exceptions\Repositories\Pterodactyl\ServerNotFoundException;
use Illuminate\Http\Request;

class GetServersController
{
    public function __construct(
        protected ServerRepositoryInterface $serverRepositoryInterface,
        protected UserRepositoryInterface $userRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $servers = $this->userRepositoryInterface->findById(auth()->id())->servers->map(function ($server) {
            try {
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
            } catch (ServerNotFoundException $e) {
                $server->delete();
            }
        });

        // check if the servers has one or more items null, and remove them
        $servers = $servers->filter(function ($server) {
            return !is_null($server);
        });

        return view('modules.servers.index', compact('servers'));
    }
}
