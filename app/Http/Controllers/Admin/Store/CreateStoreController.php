<?php

namespace App\Http\Controllers\Admin\Store;

use App\Contracts\Eloquent\StoreCategoryRepositoryInterface;
use Illuminate\Http\Request;

class CreateStoreController
{
    public function __construct(
        protected StoreCategoryRepositoryInterface $storeCategoryRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categories = $this->storeCategoryRepositoryInterface->all();

        return view('modules.admin.store.create', compact('categories'));
    }
}
