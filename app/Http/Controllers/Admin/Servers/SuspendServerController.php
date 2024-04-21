<?php

namespace App\Http\Controllers\Admin\Servers;

use App\Contracts\Eloquent\ServerRepositoryInterface as EloquentServerRepositoryInterface;
use App\Contracts\ServerRepositoryInterface;
use Illuminate\Http\Request;

class SuspendServerController
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

        $suspended = $this->serverRepositoryInterface->suspend($server->pterodactyl_server_id);

        if ($suspended) {
            $server = $this->eloquentServerRepositoryInterface->update($server->id, ['suspended' => true, 'suspended_at' => now()]);

            return response()->json([
                'message' => 'Server has been suspended.',
                'server' => $server
            ]);
        }

        return response()->json([
            'message' => 'Failed to suspend server.'
        ], 400);
    }
}
