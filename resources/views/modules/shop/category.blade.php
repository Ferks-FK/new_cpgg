@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="{{ route('home') }}">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item href="{{ route('shop') }}">Shop</x-breadcrumb.item>
        <x-breadcrumb.item href="{{ route('shop.category', $category->id) }}">{{ $category->name }}</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="shop()" x-init="setCategoriesData({{ json_encode($categories) }}); setCategoryData({{ json_encode($category) }})">
        <x-module.header>
            <x-module.title>{{ $category->name }}</x-module.title>
        </x-module.header>
        <template x-if="categories.length">
            <div class="flex flex-col gap-5 md:flex-row">
                <div class="flex flex-col justify-between w-full md:max-w-[300px]">
                    <x-card class="h-fit">
                        <x-card.content>
                            <ul class="flex flex-col flex-wrap gap-1">
                                <template x-for="category in categories" :key="category.id">
                                    <li>
                                        <a
                                            x-bind:href="`/shop/category/${category.id}`"
                                            class="flex items-center w-full gap-2 px-3 py-2 rounded-md hover:bg-slate-500"
                                            x-bind:class="category.id === categoryData.id ? 'bg-slate-500' : ''"
                                            x-text="category.name"
                                        >
                                        </a>
                                    </li>
                                </template>
                            </ul>
                        </x-card.content>
                    </x-card>
                    <x-button as="link" href="{{ route('cart') }}">
                        Cart
                    </x-button>
                </div>
                <div class="grid w-full grid-cols-1 gap-5">
                    <div class="flex flex-col gap-1 md:grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        <template x-for="product in categoryData.products">
                            <x-card class="col-span-full xl:col-span-1">
                                <x-card.content class="h-full">
                                    <div class="flex flex-col justify-between h-full gap-5">
                                        <div class="flex flex-col">
                                            <span class="text-lg" x-text="product.name"></span>
                                            <span class="text-sm" x-text="product.description"></span>
                                        </div>
                                        <div class="flex items-end justify-between">
                                            <span x-text="`$${product.price}`"></span>
                                            <x-button x-on:click="updateCart(product.id)">
                                                <span x-show="!loadingProduct[product.id]">
                                                    Add to cart
                                                </span>
                                                <span x-show="loadingProduct[product.id]">
                                                    <x-icon.loading/>
                                                </span>
                                            </x-button>
                                        </div>
                                    </div>
                                </x-card.content>
                            </x-card>
                        </template>
                    </div>
                </div>
            </div>
        </template>
        <template x-if="!categories.length">
            <x-empty>
                <x-empty.message>No products found.</x-empty.message>
            </x-empty>
        </template>
    </x-module>
@endsection
