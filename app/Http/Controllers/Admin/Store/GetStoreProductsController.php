<?php

namespace App\Http\Controllers\Admin\Store;

use App\Contracts\Eloquent\StoreRepositoryInterface;
use Illuminate\Http\Request;

class GetStoreProductsController
{
    public function __construct(
        protected StoreRepositoryInterface $storeRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = $this->storeRepositoryInterface->all(['category']);

        return view('modules.admin.store.index', compact('products'));
    }
}
