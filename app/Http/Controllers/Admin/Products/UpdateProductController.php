<?php

namespace App\Http\Controllers\Admin\Products;

use App\Contracts\ServerRepositoryInterface;
use App\Contracts\Eloquent\ProductRepositoryInterface;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Jobs\UpdateServerJob;

class UpdateProductController
{
    public function __construct(
        protected ServerRepositoryInterface $serverRepositoryInterface,
        protected ProductRepositoryInterface $productRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateProductRequest $request, int $id)
    {
        $data = $request->validated();

        $servers = $this->productRepositoryInterface->findById($id, ['servers'])->servers;

        $product = $this->productRepositoryInterface->update($id, $data);

        foreach ($servers as $server) {
            dispatch(new UpdateServerJob($server->pterodactyl_server_id, $product));
        }

        return response()->json([
            'message' => 'Product updated successfully',
            'redirect' => route('admin.products')
        ]);
    }
}
