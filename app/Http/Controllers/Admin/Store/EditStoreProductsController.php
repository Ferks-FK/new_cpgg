<?php

namespace App\Http\Controllers\Admin\Store;

use App\Contracts\Eloquent\StoreCategoryRepositoryInterface;
use App\Contracts\Eloquent\StoreRepositoryInterface;
use Illuminate\Http\Request;

class EditStoreProductsController
{
    public function __construct(
        protected StoreCategoryRepositoryInterface $storeCategoryRepositoryInterface,
        protected StoreRepositoryInterface $storeRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $product = $this->storeRepositoryInterface->findById($id);
        $categories = $this->storeCategoryRepositoryInterface->all();

        return view('modules.admin.store.edit', compact('product', 'categories'));
    }
}
