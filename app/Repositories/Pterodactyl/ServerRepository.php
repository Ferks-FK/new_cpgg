<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\ServerRepositoryInterface;
use Exception;

class ServerRepository extends ApiConfigRepository implements ServerRepositoryInterface
{
    public function all(array $includes = [])
    {
        $valid_includes = array_intersect($includes, $this->validIncludes('servers'));

        try {
            $response = $this->application()->get('servers?include=' . implode(',', $valid_includes));
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch servers.');
        }

        return $response->json()['data'];
    }

    public function findById(int $id, array $includes = [])
    {
        $valid_includes = array_intersect($includes, $this->validIncludes('servers'));

        try {
            $response = $this->application()->get("servers/{$id}?include=" . implode(',', $valid_includes));
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch server.');
        }

        return $response->json()['attributes'];
    }

    public function create(mixed $data, mixed $egg_attributes, array $allocations)
    {
        $attributes = [
            'name' => $data->name,
            'external_id' => strval($data->id),
            'user' => $data->user->pterodactyl_id,
            'egg' => $egg_attributes['id'],
            'docker_image' => $egg_attributes['docker_image'],
            'startup' => $egg_attributes['startup'],
            'environment' => $this->getEnvironmentVariables($egg_attributes),
            'limits' => [
                'memory' => $data->product->memory,
                'swap' => $data->product->swap,
                'disk' => $data->product->disk,
                'io' => $data->product->io,
                'cpu' => $data->product->cpu,
            ],
            'feature_limits' => [
                'databases' => $data->product->databases,
                'backups' => $data->product->backups,
                'allocations' => $data->product->allocations,
            ],
            'allocation' => [
                'default' => $allocations[array_rand($allocations)]
            ],
        ];

        try {
            $response = $this->application()->post('servers', $attributes);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to create server.');
        }

        return $response->json()['attributes'];
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

    public function getEggAttributes(int $nestId, int $eggId)
    {
        try {
            $response = $this->application()->get("nests/{$nestId}/eggs/{$eggId}?include=variables");
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch egg attributes.');
        }

        return $response->json()['attributes'];
    }

    private function getEnvironmentVariables(mixed $egg_attributes)
    {
        $variables = [];

        foreach ($egg_attributes['relationships']['variables']['data'] as $variable) {
            $variables[$variable['attributes']['env_variable']] = $variable['attributes']['default_value'];
        }

        return $variables;
    }

    private function validIncludes(string $endpoint)
    {
        return match ($endpoint) {
            'servers' => ['allocations', 'user', 'subusers', 'nest', 'egg', 'variables', 'location', 'node', 'databases'],
            'servers-databases' => ['password', 'host'],
            'nodes' => ['location', 'allocations'],
            'nests' => ['eggs'],
            'eggs' => ['nest', 'variables'],
            'locations' => ['nodes'],
            'allocations' => ['node'],
            default => [],
        };
    }
}