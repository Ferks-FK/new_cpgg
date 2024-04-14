<?php

return [
    'default' => env('DEFAULT_ORM', 'eloquent'),

    'eloquent' => [
        'bindings' => [
            App\Contracts\Eloquent\ProductRepositoryInterface::class => App\Repositories\Eloquent\ProductRepository::class,
            App\Contracts\Eloquent\UserRepositoryInterface::class => App\Repositories\Eloquent\UserRepository::class,
            App\Contracts\Eloquent\ServerRepositoryInterface::class => App\Repositories\Eloquent\ServerRepository::class,
        ]
    ],
];