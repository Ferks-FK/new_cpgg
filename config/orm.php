<?php

return [
    'default' => env('DEFAULT_ORM', 'eloquent'),

    'eloquent' => [
        'bindings' => [
            App\Contracts\Eloquent\ProductRepositoryInterface::class => App\Repositories\Eloquent\ProductRepository::class,
            App\Contracts\Eloquent\UserRepositoryInterface::class => App\Repositories\Eloquent\UserRepository::class,
            App\Contracts\Eloquent\ServerRepositoryInterface::class => App\Repositories\Eloquent\ServerRepository::class,
            App\Contracts\Eloquent\StoreRepositoryInterface::class => App\Repositories\Eloquent\StoreRepository::class,
            App\Contracts\Eloquent\StoreCategoryRepositoryInterface::class => App\Repositories\Eloquent\StoreCategoryRepository::class,
            App\Contracts\Eloquent\CartRepositoryInterface::class => App\Repositories\Eloquent\CartRepository::class,
            App\Contracts\Eloquent\GatewayRepositoryInterface::class => App\Repositories\Eloquent\GatewayRepository::class,
        ]
    ],
];
