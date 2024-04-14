<?php

return [
    // TODO: Change this when settings are added to the database

    'default' => env('API_PROVIDER', 'pterodactyl'),

    'pterodactyl' => [
        'url' => env('PTERODACTYL_API_URL'),
        'user_token ' => env('PTERODACTYL_API_USER_TOKEN'),
        'admin_token' => env('PTERODACTYL_API_ADMIN_TOKEN'),

        'bindings' => [
            App\Contracts\ServerRepositoryInterface::class => App\Repositories\Pterodactyl\ServerRepository::class,
            App\Contracts\NodeRepositoryInterface::class => App\Repositories\Pterodactyl\NodeRepository::class,
            App\Contracts\EggRepositoryInterface::class => App\Repositories\Pterodactyl\EggRepository::class,
            App\Contracts\UserRepositoryInterface::class => App\Repositories\Pterodactyl\UserRepository::class,
        ]
    ],

    'pelican' => [
        //
    ],
];