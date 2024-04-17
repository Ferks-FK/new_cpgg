<?php

namespace App\Http\Controllers\Admin\Users;

use App\Contracts\Eloquent\UserRepositoryInterface as EloquentUserRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\ServerRepositoryInterface;
use App\Exceptions\Repositories\Pterodactyl\ServerNotFoundException;
use Illuminate\Http\Request;

class DeleteUserController
{
    public function __construct(
        protected EloquentUserRepositoryInterface $eloquentUserRepositoryInterface,
        protected ServerRepositoryInterface $serverRepositoryInterface,
        protected UserRepositoryInterface $userRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $user = $this->eloquentUserRepositoryInterface->findById($id);

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

            $this->userRepositoryInterface->delete($user->pterodactyl_id);
        } catch (ServerNotFoundException $e) {
            // do nothing.
        }
        
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.'
        ]);
    }
}
