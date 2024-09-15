<?php

namespace App\Http\Controllers\Admin\Users;

use App\Contracts\Eloquent\UserRepositoryInterface as EloquentUserRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Exceptions\Repositories\Pterodactyl\ValidationException;
use App\Http\Requests\Admin\User\CreateUserRequest;
use Exception;

class StoreUserController
{
    public function __construct(
        protected EloquentUserRepositoryInterface $eloquentUserRepositoryInterface,
        protected UserRepositoryInterface $userRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateUserRequest $request)
    {
        $data = $request->validated();

        $data['username'] = str_replace(' ', '', $data['first_name']);

        try {
            $response = $this->userRepositoryInterface->create($data);
        } catch (ValidationException $exception) {
            $exception->throwValidationException();
        } finally {
            unset($data['username']);
        }

        $data['pterodactyl_id'] = $response['attributes']['id'];

        $this->eloquentUserRepositoryInterface->create($data);

        return response()->json([
            'message' => 'User created successfully',
            'redirect' => route('admin.users')
        ]);
    }
}
