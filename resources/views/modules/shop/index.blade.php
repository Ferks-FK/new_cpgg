@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="{{ route('home') }}">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item href="{{ route('shop') }}">Shop</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="shop()" x-init="setCategoriesData({{ json_encode($categories) }})">
        <x-module.header>
            <x-module.title>Shop</x-module.title>
        </x-module.header>
        <template x-if="categories.length">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-8">
                <x-card class="md:col-span-2 h-fit">
                    <x-card.content>
                        <ul class="flex flex-col flex-wrap gap-1">
                            <template x-for="category in categories" :key="category.id">
                                <li>
                                    <a
                                        x-bind:href="`/shop/category/${category.id}`"
                                        class="flex items-center w-full gap-2 px-3 py-2 rounded-md hover:bg-slate-500"
                                        x-text="category.name"
                                    >
                                    </a>
                                </li>
                            </template>
                        </ul>
                    </x-card.content>
                </x-card>
                <x-card class="md:col-span-6">
                    <x-card.content>
                        <span>Welcome to Store!</span>
                    </x-card.content>
                </x-card>
            </div>
        </template>
        <template x-if="!categories.length">
            <x-empty>
                <x-empty.message>No products found.</x-empty.message>
            </x-empty>
        </template>
    </x-module>
@endsection