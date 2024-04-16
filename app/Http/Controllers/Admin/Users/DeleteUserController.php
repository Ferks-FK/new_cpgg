<?php

namespace App\Http\Controllers\Admin\Users;

use App\Contracts\ServerRepositoryInterface;
use App\Exceptions\Repositories\Pterodactyl\ServerNotFoundException;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteUserController
{
    public function __construct(
        protected ServerRepositoryInterface $serverRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return response()->json([
                'message' => 'You cannot delete yourself.'
            ], 403);
        }

        try {
            foreach ($user->servers as $server) {
                $this->serverRepositoryInterface->delete($server->pterodactyl_server_id);

                $server->delete();
            }
        } catch (ServerNotFoundException $e) {
            // do nothing.
        }
        
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.'
        ]);
    }
}
