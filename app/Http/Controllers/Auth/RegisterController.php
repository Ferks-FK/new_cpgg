<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\Pterodactyl\PteroUserRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Http\Request;
use Exception;

class RegisterController
{
    /**
     * The user repository instance.
     */
    public function __construct(protected PteroUserRepository $pteroUserRepository, protected UserRepository $userRepository)
    {
    }

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
            $response = $this->pteroUserRepository->create($data);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        } finally {
            unset($data['username']);
        }

        $data['pterodactyl_id'] = $response['attributes']['id'];

        $this->userRepository->create($data);

        return response()->json([
            'message' => 'User created successfully',
            'redirect' => route('login.view')
        ]);
    }
}
