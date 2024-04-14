<?php

namespace App\Http\Controllers\Servers;

use App\Contracts\ServerRepositoryInterface;
use App\Contracts\Eloquent\ServerRepositoryInterface as EloquentServerRepositoryInterface; 
use App\Contracts\Eloquent\ProductRepositoryInterface;
use Illuminate\Http\Request;

class StoreServerController
{
    public function __construct(
        protected EloquentServerRepositoryInterface $eloquentServerRepositoryInterface,
        protected ServerRepositoryInterface $serverRepositoryInterface,
        protected ProductRepositoryInterface $productRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'nest_id' => 'required|integer',
            'egg_id' => 'required|integer',
            'node_id' => 'required|integer',
            'product_id' => 'required|exists:products,id',
        ]);

        $allocations = $this->serverRepositoryInterface->getFreeAllocations($data['node_id']);

        $server = $this->eloquentServerRepositoryInterface->create([
            'name' => $data['name'],
            'product_id' => $data['product_id'],
            'user_id' => auth()->id(),
        ]);

        $egg_attributes = $this->serverRepositoryInterface->getEggAttributes($data['nest_id'], $data['egg_id']);
        $pterodactyl_server = $this->serverRepositoryInterface->create($server, $egg_attributes, $allocations);

        $server->update([
            'pterodactyl_server_id' => $pterodactyl_server['id'],
            'identifier' => $pterodactyl_server['identifier'],
        ]);

        return response()->json([
            'message' => 'Server created successfully.',
            'redirect' => route('servers')
        ]);
    }
}
