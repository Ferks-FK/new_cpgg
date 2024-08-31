<?php

return [
    'default' => env('API_PROVIDER', 'pterodactyl'),

    'pterodactyl' => [
        'bindings' => [
            App\Contracts\ServerRepositoryInterface::class => App\Repositories\Pterodactyl\ServerRepository::class,
            App\Contracts\NodeRepositoryInterface::class => App\Repositories\Pterodactyl\NodeRepository::class,
            App\Contracts\EggRepositoryInterface::class => App\Repositories\Pterodactyl\EggRepository::class,
            App\Contracts\UserRepositoryInterface::class => App\Repositories\Pterodactyl\UserRepository::class,
            App\Contracts\LocationRepositoryInterface::class => App\Repositories\Pterodactyl\LocationRepository::class,
        ]
    ],

    'pelican' => [
        'bindings' => [
            App\Contracts\ServerRepositoryInterface::class => App\Repositories\Pelican\ServerRepository::class,
            // App\Contracts\NodeRepositoryInterface::class => App\Repositories\Pelican\NodeRepository::class,
            // App\Contracts\EggRepositoryInterface::class => App\Repositories\Pelican\EggRepository::class,
            // App\Contracts\UserRepositoryInterface::class => App\Repositories\Pelican\UserRepository::class,
        ]
    ],
];
