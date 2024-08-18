<?php

namespace App\Http\Controllers\Shop;

use App\Contracts\Eloquent\StoreCategoryRepositoryInterface;
use Illuminate\Http\Request;

class GetShopController
{
    public function __construct(
        protected StoreCategoryRepositoryInterface $storeCategoryRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categories = $this->storeCategoryRepositoryInterface->allActiveWithHasRelation('products', ['products']);

        return view('modules.shop.index', compact('categories'));
    }
}
