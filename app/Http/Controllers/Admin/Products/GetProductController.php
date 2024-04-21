<?php

namespace App\Http\Controllers\Admin\Products;

use App\Contracts\Eloquent\ProductRepositoryInterface;
use App\Models\Product;
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

        // $product = Product::first();

        // dd($product->eggs()->sync([1]));

        return view('modules.admin.products.index', compact('products'));
    }
}
