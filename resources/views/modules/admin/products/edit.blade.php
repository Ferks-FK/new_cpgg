@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item icon="icon.sliders" href="{{ route('admin.products') }}">Products</x-breadcrumb.item>
        <x-breadcrumb.item href="#">{{ $product->name }}</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="products()" x-init="setProductData({{ json_encode($product) }}); setNodesData({{ json_encode($nodes) }}); setEggsData({{ json_encode($eggs) }})">
        <x-module.header>
            <x-module.title>Edit Product</x-module.title>
        </x-module.header>
        <x-card>
            <x-card.content>
                <x-form id="updateProduct" x-on:submit.prevent="handleUpdate()">
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
                        <x-form.label for="active">Active</x-form.label>
                        <x-select x-model="form.data.active" id="active">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </x-select>
                        <x-form.error x-show="form.errors.active" x-text="form.errors.active"/>
                    </x-form.group>
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <x-form.group>
                            <x-form.label for="price">Price</x-form.label>
                            <x-form.input x-model="form.data.price" id="price"/>
                            <x-form.error x-show="form.errors.price" x-text="form.errors.price"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="minimumCredits">Minimum Credits</x-form.label>
                            <x-form.input x-model="form.data.minimum_credits" id="minimumCredits"/>
                            <x-form.error x-show="form.errors.minimum_credits" x-text="form.errors.minimum_credits"/>
                        </x-form.group>
                    </div>
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-4">
                        <x-form.group>
                            <x-form.label for="cpu">CPU</x-form.label>
                            <x-form.input x-model="form.data.cpu" id="cpu"/>
                            <x-form.error x-show="form.errors.cpu" x-text="form.errors.cpu"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="memory">Memory</x-form.label>
                            <x-form.input x-model="form.data.memory" id="memory"/>
                            <x-form.error x-show="form.errors.memory" x-text="form.errors.memory"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="disk">Disk</x-form.label>
                            <x-form.input x-model="form.data.disk" id="disk"/>
                            <x-form.error x-show="form.errors.disk" x-text="form.errors.disk"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="swap">Swap</x-form.label>
                            <x-form.input x-model="form.data.swap" id="swap"/>
                            <x-form.error x-show="form.errors.swap" x-text="form.errors.swap"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="io">IO</x-form.label>
                            <x-form.input x-model="form.data.io" id="io"/>
                            <x-form.error x-show="form.errors.io" x-text="form.errors.io"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="database">Databases</x-form.label>
                            <x-form.input x-model="form.data.databases" id="database"/>
                            <x-form.error x-show="form.errors.databases" x-text="form.errors.databases"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="backups">Backups</x-form.label>
                            <x-form.input x-model="form.data.backups" id="backups"/>
                            <x-form.error x-show="form.errors.backups" x-text="form.errors.backups"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="allocations">Allocations</x-form.label>
                            <x-form.input x-model="form.data.allocations" id="allocations"/>
                            <x-form.error x-show="form.errors.allocations" x-text="form.errors.allocations"/>
                        </x-form.group>
                    </div>
                    <x-form.footer>
                        <x-button type="button" x-on:click="handleConfirm('updateProduct')" class="!w-full md:!w-fit">
                            Update Product
                        </x-button>
                    </x-form.footer>
                </x-form>
            </x-card.content>
        </x-card>
        <x-card>
            <x-card.title>
                Product Link
            </x-card.title>
            <x-card.subtitle>
                This product will only be available for the nodes and eggs selected below.
            </x-card.subtitle>
            <x-card.content>
                <x-form.group>
                    <x-form.label for="nodes">Nodes</x-form.label>
                    <x-multiselect name="form.data.nodes">
                        <template x-for="node in nodes" :key="node.attributes.id">
                            <x-multiselect.option x-bind:name="node.attributes.name" x-bind:value="node.attributes.id"/>
                        </template>
                    </x-multiselect>
                </x-form.group>
                <x-form.group>
                    <x-form.label for="eggs">Eggs</x-form.label>
                    <x-multiselect name="form.data.eggs">
                        <template x-for="egg in eggs" :key="egg.attributes.id">
                            <x-multiselect.option x-bind:name="egg.attributes.name" x-bind:value="egg.attributes.id"/>
                        </template>
                    </x-multiselect>
                </x-form.group>
            </x-card.content>
        </x-card>
        <x-confirm name="updateProduct">
            <x-confirm.content>
                <x-confirm.header>
                    Update Product
                </x-confirm.header>
                <x-confirm.body>
                    <p>All servers that have been created using this product will also have their <span class="font-bold">resources updated</span>, which can overload your node if the resources exceed the limits. Want to upgrade anyway?</p>
                </x-confirm.body>
                <x-confirm.footer>
                    <x-button form="updateProduct" type="submit" class="!w-full md:!w-fit">
                        <span x-show="!form.loading">
                            Update Product
                        </span>
                        <span x-show="form.loading">
                            <x-icon.loading/>
                        </span>
                    </x-button>
                </x-confirm.footer>
            </x-confirm.content>
        </x-confirm>
    </x-module>
@endsection