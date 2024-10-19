<?php

namespace App\Tasks;

use App\Contracts\Eloquent\ServerRepositoryInterface;
use App\Jobs\SuspendServerJob;

class ChargeUsers
{
    protected $serverRepositoryInterface;

    public function __construct()
    {
        $this->serverRepositoryInterface = app(ServerRepositoryInterface::class);
    }

    public function __invoke()
    {
        $servers = $this->serverRepositoryInterface->allActives(['user', 'product']);

        $serversToSuspend = [];
        $usersToNotify = [];

        foreach ($servers as $server) {
            // price per hour
            $price = ($server->product->price / 30) / 24;

            if ($server->user->credits >= $price) {
                $server->user->decrement('credits', $price);
            } else {
                $server->update(['suspended' => true, 'suspended_at' => now()]);

                $serversToSuspend[] = $server;
                $usersToNotify[] = $server->user;
            }
        }

        foreach($serversToSuspend as $server) {
            dispatch(new SuspendServerJob($server->pterodactyl_server_id));
        }
    }
}
