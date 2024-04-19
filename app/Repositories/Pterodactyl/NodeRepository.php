<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\NodeRepositoryInterface;
use Exception;

class NodeRepository extends ApiConfigRepository implements NodeRepositoryInterface
{
    public function all(array $includes = [])
    {
        $valid_includes = array_intersect($includes, $this->validIncludes('nodes'));

        try {
            $response = $this->application()->get("nodes?include=" . implode(',', $valid_includes));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch nodes.');
        }

        return $response->json()['data'];
    }

    public function getFreeAllocations(int $nodeId)
    {
        try {
            $response = $this->application()->get("nodes/{$nodeId}/allocations");
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch allocations.');
        }

        $freeAllocations = [];

        foreach ($response->json()['data'] as $allocation) {
            if (!$allocation['attributes']['assigned']) {
                $freeAllocations[] = $allocation['attributes']['id'];
            }
        }

        return $freeAllocations;
    }

    private function validIncludes(string $endpoint)
    {
        return match ($endpoint) {
            'nodes' => ['allocations', 'location', 'servers'],
            'node-allocations' => ['node', 'server'],
            default => [],
        };
    }
}