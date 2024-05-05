@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item icon="icon.shopping-basket" href="{{ route('admin.store') }}">Store</x-breadcrumb.item>
        <x-breadcrumb.item href="#">Create</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="store()">
        <x-module.header>
            <x-module.title>Store</x-module.title>
        </x-module.header>
        <x-card>
            <x-card.content>
                <x-form x-on:submit.prevent="handleCreate()">
                    <x-form.group>
                        <x-form.label for="name">Name</x-form.label>
                        <x-form.input x-model="form.data.name" id="name"/>
                        <x-form.error x-show="form.errors.name" x-text="form.errors.name"/>
                    </x-form.group>
                    <x-form.group>
                        <x-form.label for="description">Description</x-form.label>
                        <x-form.input x-model="form.data.description" id="description"/>
                        <x-form.error x-show="form.errors.description" x-text="form.errors.description"/>
                    </x-form.group>
                    <x-form.group>
                        <x-form.label for="type">Type</x-form.label>
                        <x-select x-model="form.data.type" id="type">
                            <option value="credits">Credits</option>
                            <option value="slots">Server Slots</option>
                        </x-select>
                        <x-form.error x-show="form.errors.type" x-text="form.errors.type"/>
                    </x-form.group>
                    <x-form.group>
                        <x-form.label for="price">Price</x-form.label>
                        <x-form.input x-model="form.data.price" id="price"/>
                        <x-form.error x-show="form.errors.price" x-text="form.errors.price"/>
                    </x-form.group>
                    <x-form.group>
                        <x-form.label for="quantity">Quantity</x-form.label>
                        <x-form.input x-model="form.data.quantity" id="quantity"/>
                        <x-form.error x-show="form.errors.quantity" x-text="form.errors.quantity"/>
                    </x-form.group>
                    <x-form.group>
                        <x-form.label for="categoryId">Category</x-form.label>
                        <x-select x-model="form.data.category_id" id="categoryId">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-form.error x-show="form.errors.category" x-text="form.errors.category"/>
                    </x-form.group>
                    <x-form.group>
                        <x-form.label for="active">Active</x-form.label>
                        <x-select x-model="form.data.active" id="active">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </x-select>
                        <x-form.error x-show="form.errors.active" x-text="form.errors.active"/>
                    </x-form.group>
                    <x-form.footer>
                        <x-button type="submit">
                            <span x-show="!form.loading">
                                Create Product
                            </span>
                            <span x-show="form.loading">
                                <x-icon.loading/>
                            </span>
                        </x-button>
                    </x-form.footer>
                </x-form>
            </x-card.content>
        </x-card>
    </x-module>
@endsection