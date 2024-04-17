<?php

namespace App\Http\Controllers\Admin\Users;

use App\Contracts\Eloquent\UserRepositoryInterface;
use Illuminate\Http\Request;

class EditUserController
{
    public function __construct(
        protected UserRepositoryInterface $userRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $user = $this->userRepositoryInterface->findById($id);

        return view('modules.admin.users.edit', compact('user'));
    }
}
