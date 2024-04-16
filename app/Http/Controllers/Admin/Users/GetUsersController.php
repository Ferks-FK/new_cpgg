<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;

class GetUsersController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $users = User::with('servers')->get();

        return view('modules.admin.users.index', compact('users'));
    }
}
