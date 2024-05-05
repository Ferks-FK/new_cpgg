<?php

namespace App\Http\Controllers\Admin\Store;

use App\Contracts\Eloquent\StoreRepositoryInterface;
use App\Http\Requests\Admin\Store\CreateProductStoreRequest;

class StoreStoreProductsController
{
    public function __construct(
        protected StoreRepositoryInterface $storeRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateProductStoreRequest $request)
    {
        $data = $request->validated();

        $this->storeRepositoryInterface->create($data);

        return response()->json([
            'message' => 'Product created successfully',
            'redirect' => route('admin.store'),
        ]);
    }
}
