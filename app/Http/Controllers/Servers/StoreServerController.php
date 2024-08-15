<?php

namespace App\Http\Controllers\Servers;

use App\Contracts\EggRepositoryInterface;
use App\Contracts\ServerRepositoryInterface;
use App\Contracts\NodeRepositoryInterface;
use App\Contracts\Eloquent\ServerRepositoryInterface as EloquentServerRepositoryInterface;
use App\Contracts\Eloquent\ProductRepositoryInterface;
use App\Contracts\LocationRepositoryInterface;
use App\Exceptions\Repositories\Pterodactyl\ServerCreationFailedException;
use App\Http\Requests\Server\CreateServerRequest;
class StoreServerController
{
    public function __construct(
        protected EloquentServerRepositoryInterface $eloquentServerRepositoryInterface,
        protected NodeRepositoryInterface $nodeRepositoryInterface,
        protected EggRepositoryInterface $eggRepositoryInterface,
        protected ServerRepositoryInterface $serverRepositoryInterface,
        protected ProductRepositoryInterface $productRepositoryInterface,
        protected LocationRepositoryInterface $locationRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateServerRequest $request)
    {
        $data = $request->validated();

        try {
            $location = $this->locationRepositoryInterface->findById($data['location_id'], ['nodes']);

            $product = $this->productRepositoryInterface->findById($data['product_id']);

            $nodes = [];

            foreach($location['attributes']['relationships']['nodes']['data'] as $node) {
                $free_memory = ($node['attributes']['memory'] * ($node['attributes']['memory_overallocate'] + 100) / 100) - $node['attributes']['allocated_resources']['memory'];
                $free_disk = ($node['attributes']['disk'] * ($node['attributes']['disk_overallocate'] + 100) / 100) - $node['attributes']['allocated_resources']['disk'];

                if ($product->memory < $free_memory && $product->disk < $free_disk) {
                    $nodes[] = $node;
                }
            }

            $data['node_id'] = $nodes[array_rand($nodes)]['attributes']['id'];

            $allocations = $this->nodeRepositoryInterface->getFreeAllocations($data['node_id']);

            if (count($allocations) < 1) {
                return response()->json([
                    'message' => 'No free allocations available on this node.',
                    'redirect' => route('servers')
                ], 400);
            }

            $server = $this->eloquentServerRepositoryInterface->create([
                'name' => $data['name'],
                'product_id' => $data['product_id'],
                'user_id' => auth()->id(),
            ]);

            $egg_attributes = $this->eggRepositoryInterface->getEggAttributes($data['egg_id']);

            if (empty($egg_attributes)) {
                $server->delete();

                return response()->json([
                    'message' => 'Failed to fetch egg attributes.',
                    'redirect' => route('servers')
                ], 400);
            }

            $pterodactyl_server = $this->serverRepositoryInterface->create($server, $egg_attributes, $allocations, $data['egg_variables']);

            $server->update([
                'pterodactyl_server_id' => $pterodactyl_server['id'],
                'identifier' => $pterodactyl_server['identifier'],
            ]);

            return response()->json([
                'message' => 'Server created successfully.',
                'redirect' => route('servers')
            ]);
        } catch (ServerCreationFailedException $e) {
            $server->delete();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
