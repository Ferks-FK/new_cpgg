<?php

namespace App\Http\Controllers\Admin\Products;

use App\Contracts\Eloquent\ProductRepositoryInterface;
use Illuminate\Http\Request;

class DeleteProductController
{
    public function __construct(
        protected ProductRepositoryInterface $productRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $product = $this->productRepositoryInterface->findById($id, ['servers']);

        if ($product->servers->count() > 0) {
            return response()->json([
                'message' => 'Product has servers, cannot be deleted.'
            ], 400);
        }

        $this->productRepositoryInterface->delete($id);

        return response()->json([
            'message' => 'Product deleted successfully.'
        ]);
    }
}
