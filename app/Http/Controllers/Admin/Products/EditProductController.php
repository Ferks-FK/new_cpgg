<?php

namespace App\Http\Controllers\Admin\Products;

use App\Contracts\Eloquent\ProductRepositoryInterface;
use App\Contracts\NodeRepositoryInterface;
use App\Contracts\EggRepositoryInterface;
use Illuminate\Http\Request;

class EditProductController
{
    public function __construct(
        protected NodeRepositoryInterface $nodeRepositoryInterface,
        protected EggRepositoryInterface $eggRepositoryInterface,
        protected ProductRepositoryInterface $productRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $product = $this->productRepositoryInterface->findById($id);
        $eggs = $this->eggRepositoryInterface->all();
        $nodes = $this->nodeRepositoryInterface->all();

        return view('modules.admin.products.edit', compact('product', 'eggs', 'nodes'));
    }
}
