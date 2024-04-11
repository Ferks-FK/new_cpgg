<?php

namespace App\Http\Controllers\Servers;

use App\Repositories\Eloquent\UserRepository;
use Illuminate\Http\Request;

class GetServersController
{
    public function __construct(protected UserRepository $userRepository)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $servers = $this->userRepository->find(auth()->id())->servers;

        return view('modules.servers.index', compact('servers'));
    }
}
