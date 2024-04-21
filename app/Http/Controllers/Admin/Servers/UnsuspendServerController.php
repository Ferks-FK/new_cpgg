<?php

namespace App\Http\Controllers\Admin\Servers;

use App\Contracts\Eloquent\ServerRepositoryInterface as EloquentServerRepositoryInterface;
use App\Contracts\ServerRepositoryInterface;
use Illuminate\Http\Request;

class UnsuspendServerController
{
    public function __construct(
        protected EloquentServerRepositoryInterface $eloquentServerRepositoryInterface,
        protected ServerRepositoryInterface $serverRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $server = $this->eloquentServerRepositoryInterface->findById($request->id);

        $unsuspended = $this->serverRepositoryInterface->unsuspend($server->pterodactyl_server_id);

        if ($unsuspended) {
            $server = $this->eloquentServerRepositoryInterface->update($server->id, ['suspended' => false, 'suspended_at' => null]);

            return response()->json([
                'message' => 'Server has been unsuspended.',
                'server' => $server
            ]);
        }

        return response()->json([
            'message' => 'Failed to unsuspend server.'
        ], 400);
    }
}
