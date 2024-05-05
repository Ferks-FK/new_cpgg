<?php

namespace App\Http\Controllers\Shop;

use App\Contracts\Eloquent\StoreCategoryRepositoryInterface;
use Illuminate\Http\Request;

class GetCategoryController
{
    public function __construct(
        protected StoreCategoryRepositoryInterface $storeCategoryRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $categories = $this->storeCategoryRepositoryInterface->all(['products']);
        $category = $this->storeCategoryRepositoryInterface->find($id, ['products']);

        if (!$category) {
            abort(404);
        }

        return view('modules.shop.category', compact('categories', 'category'));
    }
}
