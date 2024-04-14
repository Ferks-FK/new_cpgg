<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Eloquent\UserRepositoryInterface as EloquentUserContract;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Exception;

class RegisterController
{
    /**
     * The user repository instance.
     */
    public function __construct(
        protected UserRepositoryInterface $userRepositoryInterface,
        protected EloquentUserContract $eloquentUserContract)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['username'] = $data['first_name'];

        try {
            $response = $this->userRepositoryInterface->create($data);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        } finally {
            unset($data['username']);
        }

        $data['pterodactyl_id'] = $response['attributes']['id'];

        $this->eloquentUserContract->create($data);

        return response()->json([
            'message' => 'User created successfully',
            'redirect' => route('login.view')
        ]);
    }
}
