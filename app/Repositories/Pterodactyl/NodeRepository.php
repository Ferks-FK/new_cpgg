<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\NodeRepositoryInterface;
use Exception;

class NodeRepository extends ApiConfigRepository implements NodeRepositoryInterface
{
    public function all(array $includes = [])
    {
        $valid_includes = array_intersect($includes, $this->validIncludes('locations'));

        try {
            $response = $this->application()->get("locations?include=" . implode(',', $valid_includes));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch locations.');
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

    public function getEggAttributes(int $nestId, int $eggId, array $includes = [])
    {
        $valid_includes = array_intersect($includes, $this->validIncludes('nest-eggs'));

        try {
            $response = $this->application()->get("nests/{$nestId}/eggs/{$eggId}?include=" . implode(',', $valid_includes));
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch egg attributes.');
        }

        return $response->json()['attributes'];
    }

    private function validIncludes(string $endpoint)
    {
        return match ($endpoint) {
            'nodes' => ['allocations', 'location', 'servers'],
            'node-allocations' => ['node', 'server'],
            'nests' => ['eggs', 'servers'],
            'nest-eggs' => ['nest', 'servers', 'config', 'script', 'variables'],
            'locations' => ['nodes', 'servers'],
            default => [],
        };
    }
}