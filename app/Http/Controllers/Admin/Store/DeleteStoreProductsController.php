<?php

namespace App\Http\Controllers\Admin\Store;

use App\Contracts\Eloquent\StoreRepositoryInterface;
use Illuminate\Http\Request;

class DeleteStoreProductsController
{
    public function __construct(
        protected StoreRepositoryInterface $storeRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $this->storeRepositoryInterface->delete($id);

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }
}
