<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\EggRepositoryInterface;
use Exception;

class EggRepository extends ApiConfigRepository implements EggRepositoryInterface
{
    public function all(array $includes = ['eggs'])
    {
        $valid_includes = array_intersect($includes, $this->validIncludes('nests'));

        try {
            $response = $this->application()->get("nests?include=" . implode(',', $valid_includes));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch eggs.');
        }

        $eggs = [];

        foreach ($response->json()['data'] as $nest) {
            foreach ($nest['attributes']['relationships']['eggs']['data'] as $egg) {
                $eggs[] = $egg;
            }
        }

        return $eggs;
    }

    public function getEggAttributes(int $egg_id, array $includes = ['eggs.variables'])
    {
        $valid_includes = array_intersect($includes, $this->validIncludes('nests'));

        try {
            $response = $this->application()->get("nests?include=" . implode(',', $valid_includes));
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to fetch egg attributes.');
        }

        $egg_attributes = [];

        foreach ($response->json()['data'] as $nest) {
            foreach ($nest['attributes']['relationships']['eggs']['data'] as $egg) {
                if ($egg['attributes']['id'] == $egg_id) {
                    $egg_attributes[] = $egg['attributes'];

                    break;
                }
            }
        }

        return empty($egg_attributes) ? $egg_attributes : $egg_attributes[0];
    }

    private function validIncludes(string $endpoint)
    {
        return match ($endpoint) {
            'nests' => ['eggs', 'eggs.variables', 'servers'],
            'nest-eggs' => ['nest', 'servers', 'config', 'script', 'variables'],
            default => [],
        };
    }
}