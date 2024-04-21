<?php

namespace App\Http\Controllers\Admin\Products;

use App\Contracts\NodeRepositoryInterface;
use App\Contracts\EggRepositoryInterface;
use Illuminate\Http\Request;

class CreateProductController
{
    public function __construct(
        protected NodeRepositoryInterface $nodeRepositoryInterface,
        protected EggRepositoryInterface $eggRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $eggs = $this->eggRepositoryInterface->all();
        $nodes = $this->nodeRepositoryInterface->all();

        return view('modules.admin.products.create', compact('eggs', 'nodes'));
    }
}
