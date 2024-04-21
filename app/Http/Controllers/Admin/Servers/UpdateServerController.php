<?php

namespace App\Http\Controllers\Admin\Servers;

use App\Contracts\Eloquent\ServerRepositoryInterface as EloquentServerRepositoryInterface;
use App\Contracts\ServerRepositoryInterface;
use App\Http\Requests\Admin\Server\UpdateServerRequest;

class UpdateServerController
{
    public function __construct(
        protected EloquentServerRepositoryInterface $eloquentServerRepositoryInterface,
        protected ServerRepositoryInterface $serverRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateServerRequest $request, $id)
    {
        $data = $request->validated();

        $server = $this->eloquentServerRepositoryInterface->update($id, $data);

        $server_data = [
            'name' => $data['name'],
            'user' => $server->user->pterodactyl_id,
            'external_id' => strval($server->id),
        ];

        $this->serverRepositoryInterface->updateDetails($server->pterodactyl_server_id, $server_data);

        return response()->json([
            'message' => 'Server updated successfully.',
            'redirect' => route('admin.servers'),
        ]);
    }
}
