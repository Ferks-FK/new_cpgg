<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class LogoutController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        auth()->logout();

        return to_route('login.view');
    }
}
