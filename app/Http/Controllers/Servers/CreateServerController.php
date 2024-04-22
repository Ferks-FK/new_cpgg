<?php

namespace App\Http\Controllers\Servers;

use App\Contracts\Eloquent\ProductRepositoryInterface;
use App\Contracts\EggRepositoryInterface;
use App\Contracts\NodeRepositoryInterface;
use Illuminate\Http\Request;

class CreateServerController
{
    public function __construct(
        protected ProductRepositoryInterface $productRepositoryInterface,
        protected EggRepositoryInterface $eggRepositoryInterface,
        protected NodeRepositoryInterface $nodeRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = $this->productRepositoryInterface->getActives();
        $server_eggs = $this->eggRepositoryInterface->all();
        $server_nodes = $this->nodeRepositoryInterface->all();

        // Get all unique eggs from products
        $product_eggs = array_unique(array_merge(...$products->map(fn ($product) => $product->eggs)->toArray()));

        // Get all unique nodes from products
        $product_nodes = array_unique(array_merge(...$products->map(fn ($product) => $product->nodes)->toArray()));

        // Get all eggs and nodes ids from server
        $server_egg_ids = array_column($server_eggs, 'id');
        $server_node_ids = array_column($server_nodes, 'id');

        // Filter the products eggs that exist in the server eggs and get their attributes
        $valid_eggs = array_filter($server_eggs, fn ($server_egg) => in_array($server_egg['attributes']['id'], $product_eggs));

        // Extract only the attributes of the valid eggs
        $valid_eggs = array_map(function ($egg) {
            return [
                'id' => $egg['attributes']['id'],
                'name' => $egg['attributes']['name']
            ];
        }, $valid_eggs);

        // Filter the products nodes that exist in the server nodes and get their attributes
        $valid_nodes = array_filter($server_nodes, fn ($server_node) => in_array($server_node['attributes']['id'], $product_nodes));

        // Extract only the attributes of the valid nodes
        $valid_nodes = array_map(function ($node) {
            return [
                'id' => $node['attributes']['id'],
                'name' => $node['attributes']['name'],
                'memory' => $node['attributes']['memory'],
                'disk' => $node['attributes']['disk'],
                'memory_overallocate' => $node['attributes']['memory_overallocate'],
                'disk_overallocate' => $node['attributes']['disk_overallocate'],
                'allocated_resources' => [
                    'memory' => $node['attributes']['allocated_resources']['memory'],
                    'disk' => $node['attributes']['allocated_resources']['disk']
                ]
            ];
        }, $valid_nodes);

        $eggs = $valid_eggs;
        $nodes = $valid_nodes;

        return view('modules.servers.create', compact('eggs', 'nodes', 'products'));
    }
}
