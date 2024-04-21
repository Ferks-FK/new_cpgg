<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Contracts\Eloquent\UserRepositoryInterface as EloquentUserRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use Exception;

class UpdateUserController
{
    public function __construct(
        protected UserRepositoryInterface $userRepositoryInterface,
        protected EloquentUserRepositoryInterface $eloquentUserRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateUserRequest $request, int $id)
    {
        $data = $request->validated();

        $data['username'] = str_replace(' ', '', $data['first_name']);

        $user = $this->eloquentUserRepositoryInterface->findById($id);

        try {
            $this->userRepositoryInterface->update($data, $user->pterodactyl_id);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        } finally {
            unset($data['username']);
        }

        $this->eloquentUserRepositoryInterface->update($data, $id);

        return response()->json([
            'message' => 'User updated successfully',
            'redirect' => route('admin.users')
        ]);
    }
}
