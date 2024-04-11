<?php

namespace App\Http\Controllers\Servers;

use App\Repositories\Pterodactyl\PteroNestRepository;
use Illuminate\Http\Request;

class GetNestEggsController
{
    public function __construct(protected PteroNestRepository $pterodactylNestRepository)
    { 
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $nest)
    {
        $eggs = $this->pterodactylNestRepository->getEggs($nest);

        return response()->json($eggs);
    }
}
