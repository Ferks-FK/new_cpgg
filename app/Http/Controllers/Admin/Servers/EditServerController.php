<?php

namespace App\Http\Controllers\Admin\Servers;

use App\Contracts\Eloquent\ServerRepositoryInterface;
use App\Contracts\Eloquent\UserRepositoryInterface;
use Illuminate\Http\Request;

class EditServerController
{
    public function __construct(
        protected ServerRepositoryInterface $serverRepositoryInterface,
        protected UserRepositoryInterface $userRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $server = $this->serverRepositoryInterface->findById($id, ['product', 'user']);
        $users = $this->userRepositoryInterface->all();

        return view('modules.admin.servers.edit', compact('server', 'users'));
    }
}
