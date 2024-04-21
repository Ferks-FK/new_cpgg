<?php

namespace App\Http\Controllers\Admin\Servers;

use App\Contracts\Eloquent\ServerRepositoryInterface as EloquentServerRepositoryInterface;
use App\Contracts\ServerRepositoryInterface;
use Illuminate\Http\Request;

class DeleteServerController
{
    public function __construct(
        protected EloquentServerRepositoryInterface $eloquentServerRepositoryInterface,
        protected ServerRepositoryInterface $serverRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $server = $this->eloquentServerRepositoryInterface->delete($id);

        $this->serverRepositoryInterface->delete($server->pterodactyl_server_id);

        return response()->json([
            'message' => 'Server deleted successfully.'
        ]);
    }
}
