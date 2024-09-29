<?php

namespace App\Repositories\Pterodactyl;

use App\Contracts\ServerRepositoryInterface;
use App\Exceptions\Repositories\Pterodactyl\ServerNotFoundException;
use App\Exceptions\Repositories\Pterodactyl\ServerCreationFailedException;
use Exception;

class ServerRepository extends ApiConfigRepository implements ServerRepositoryInterface
{
    public function all(array $includes = [])
    {
        $includes = $this->getIncludes($includes, 'servers');

        try {
            $response = $this->application()->get('servers' . $includes);
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
        $includes = $this->getIncludes($includes, 'servers');

        try {
            $response = $this->application()->get("servers/{$id}" . $includes);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new ServerNotFoundException();
        }

        return $response->json()['attributes'];
    }

    public function create(mixed $data, mixed $egg_attributes, array $allocations, array $intall_variables)
    {
        $attributes = [
            'name' => $data->name,
            'external_id' => strval($data->id),
            'user' => $data->user->pterodactyl_id,
            'egg' => $egg_attributes['id'],
            'docker_image' => $egg_attributes['docker_image'],
            'startup' => $egg_attributes['startup'],
            'environment' => $this->getEnvironmentVariables($egg_attributes, $intall_variables),
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
            throw new ServerCreationFailedException();
        }

        return $response->json()['attributes'];
    }

    public function updateDetails(int $id, mixed $data)
    {
        try {
            $response = $this->application()->patch("servers/{$id}/details", $data);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to update server.');
        }

        return $response->json()['attributes'];
    }

    public function updateBuild(int $id, mixed $data)
    {
        try {
            $response = $this->application()->patch("servers/{$id}/build", $data);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new Exception('Failed to update server build.');
        }

        return $response->json()['attributes'];
    }

    public function suspend(int $id)
    {
        try {
            $response = $this->application()->post("servers/{$id}/suspend");
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new ServerNotFoundException('Failed to suspend server.');
        }

        return true;
    }

    public function unsuspend(int $id)
    {
        try {
            $response = $this->application()->post("servers/{$id}/unsuspend");
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new ServerNotFoundException('Failed to unsuspend server.');
        }

        return true;
    }

    public function delete(int $id)
    {
        try {
            $response = $this->application()->delete("servers/{$id}");
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        if ($response->failed()) {
            throw new ServerNotFoundException('Failed to delete server.');
        }

        return true;
    }

    private function getEnvironmentVariables(mixed $egg_attributes, array $intall_variables = [])
    {
        $variables = [];

        foreach ($egg_attributes['relationships']['variables']['data'] as $variable) {
            $variables[$variable['attributes']['env_variable']] = $variable['attributes']['default_value'];
        }

        foreach ($intall_variables as $install_variable) {
            $variables[$install_variable['id']] = $install_variable['value'];
        }

        return $variables;
    }
}
