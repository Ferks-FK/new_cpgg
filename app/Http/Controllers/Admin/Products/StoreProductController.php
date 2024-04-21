<?php

namespace App\Http\Controllers\Admin\Products;

use App\Contracts\Eloquent\ProductRepositoryInterface;
use App\Http\Requests\Admin\Product\CreateProductRequest;

class StoreProductController
{
    public function __construct(
        protected ProductRepositoryInterface $productRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateProductRequest $request)
    {
        $data = $request->validated();

        $this->productRepositoryInterface->create($data);

        return response()->json([
            'message' => 'Product created successfully.',
            'redirect' => route('admin.products')
        ]);
    }
}
