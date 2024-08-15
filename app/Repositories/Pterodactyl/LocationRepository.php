<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\LocationRepositoryInterface;
use Exception;

class LocationRepository extends ApiConfigRepository implements LocationRepositoryInterface
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

    public function findById(int $id, array $includes = [])
    {
        $valid_includes = array_intersect($includes, $this->validIncludes('locations'));

        try {
            $response = $this->application()->get("locations/$id?include=" . implode(',', $valid_includes));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch location.');
        }

        return $response->json();
    }

    private function validIncludes(string $endpoint)
    {
        return match ($endpoint) {
            'locations' => ['nodes', 'servers'],
            default => [],
        };
    }
}
