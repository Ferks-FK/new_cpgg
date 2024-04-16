<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;

class LoginController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $data = $request->validated();

        if (auth()->attempt($request->only('email', 'password'), $data['remember'])) {
            return response()->json([
                'redirect' => route('home'),
            ]);
        }

        return response()->json([
            'errors' => [
                'email' => [
                    'These credentials do not match our records.'
                ]
            ],
        ], 422);
    }
}
