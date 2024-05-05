<?php

namespace App\Http\Controllers\Admin\Store;

use App\Contracts\Eloquent\StoreRepositoryInterface;
use App\Http\Requests\Admin\Store\UpdateProductStoreRequest;

class UpdateStoreProductsController
{
    public function __construct(
        protected StoreRepositoryInterface $storeRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateProductStoreRequest $request, int $id)
    {
        $data = $request->validated();

        $this->storeRepositoryInterface->update($data, $id);
        
        return response()->json([
            'message' => 'Product updated successfully',
            'redirect' => route('admin.store'),
        ]);
    }
}
