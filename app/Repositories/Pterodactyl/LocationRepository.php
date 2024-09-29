<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\LocationRepositoryInterface;
use Exception;

class LocationRepository extends ApiConfigRepository implements LocationRepositoryInterface
{
    public function all(array $includes = [])
    {
        $includes = $this->getIncludes($includes, 'locations');

        try {
            $response = $this->application()->get('locations' . $includes);
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
        $includes = $this->getIncludes($includes, 'locations');

        try {
            $response = $this->application()->get("locations/$id" . $includes);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch location.');
        }

        return $response->json();
    }
}
