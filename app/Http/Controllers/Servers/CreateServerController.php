<?php

namespace App\Http\Controllers\Servers;

use App\Contracts\Eloquent\ProductRepositoryInterface;
use App\Contracts\EggRepositoryInterface;
use App\Contracts\NodeRepositoryInterface;
use Illuminate\Http\Request;

class CreateServerController
{
    public function __construct(
        protected ProductRepositoryInterface $productRepositoryInterface,
        protected EggRepositoryInterface $eggRepositoryInterface,
        protected NodeRepositoryInterface $nodeRepositoryInterface
    )
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = $this->productRepositoryInterface->getActives();
        $eggs = $this->eggRepositoryInterface->all();
        $nodes = $this->nodeRepositoryInterface->all();

        return view('modules.servers.create', compact('eggs', 'nodes', 'products'));
    }
}
