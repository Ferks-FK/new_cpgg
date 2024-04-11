<?php

namespace App\Http\Controllers\Servers;

use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Pterodactyl\PteroNestRepository;
use App\Repositories\Pterodactyl\PteroLocationRepository;
use Illuminate\Http\Request;

class CreateServerController
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected PteroNestRepository $pterodactylNestRepository,
        protected PteroLocationRepository $pterodactylLocationRepository
    )
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = $this->productRepository->findWhere('active', true)->get();
        $nests = $this->pterodactylNestRepository->all();
        $locations = $this->pterodactylLocationRepository->all(
            includes: ['nodes']
        );

        return view('modules.servers.create', compact('nests', 'locations', 'products'));
    }
}
