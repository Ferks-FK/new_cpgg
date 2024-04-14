<?php

namespace App\Http\Controllers\Servers;

use App\Contracts\EggRepositoryInterface;
use Illuminate\Http\Request;

class GetNestEggsController
{
    public function __construct(
        protected EggRepositoryInterface $eggRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $nest)
    {
        $eggs = $this->eggRepositoryInterface->getEggs($nest);

        return response()->json($eggs);
    }
}
