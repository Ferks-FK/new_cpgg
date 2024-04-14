<?php

namespace App\Http\Controllers\Admin\Products;

use App\Contracts\Eloquent\ProductRepositoryInterface;
use Illuminate\Http\Request;

class GetProductController
{
    public function __construct(
        protected ProductRepositoryInterface $productRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = $this->productRepositoryInterface->getAll();

        return view('modules.admin.products.index', compact('products'));
    }
}
