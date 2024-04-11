<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class LoginController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
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
