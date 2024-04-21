@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item icon="icon.sliders" href="#">Products</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="products()" x-init="setProductsData({{ json_encode($products) }})">
        <x-module.header>
            <x-module.title>Products</x-module.title>
            <x-module.options>
                <x-module.create href="{{ route('admin.products.create') }}"/>
            </x-module.options>
        </x-module.header>
        <template x-if="products.length">
            <x-card>
                <x-card.content>
                    <x-table>
                        <x-table.thead>
                            <x-table.tr>
                                <x-table.th>Id</x-table.th>
                                <x-table.th>Name</x-table.th>
                                <x-table.th>Description</x-table.th>
                                <x-table.th>Price</x-table.th>
                                <x-table.th>Memory</x-table.th>
                                <x-table.th>Disk</x-table.th>
                                <x-table.th>Cpu</x-table.th>
                                <x-table.th>Swap</x-table.th>
                                <x-table.th>Database</x-table.th>
                                <x-table.th>Backups</x-table.th>
                                <x-table.th>Min Credits</x-table.th>
                                <x-table.th>Servers</x-table.th>
                                <x-table.th>Created At</x-table.th>
                                <x-table.th></x-table.th>
                            </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody>
                            <template x-for="product in products" :key="product.id">
                                <x-table.tr>
                                    <x-table.td>
                                        <span x-text="product.id"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="product.name"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="product.description"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="product.price"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="product.memory"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="product.disk"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="product.cpu"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="product.swap"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="product.databases"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="product.backups"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="product.minimum_credits"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span>0</span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="product.created_at"></span>
                                    </x-table.td>
                                    <x-table.td class="flex justify-end">
                                        <x-dropdown>
                                            <x-dropdown.trigger>
                                                <x-icon.more-vertical/>
                                            </x-dropdown.trigger>
                                            <x-dropdown.menu>
                                                <x-dropdown.item x-bind:href="`/admin/products/edit/${product.id}`">Edit</x-dropdown.item>
                                                <x-dropdown.divider/>
                                                <x-dropdown.item href="#" background="danger" x-on:click="handleConfirm('delete')">Delete</x-dropdown.item>
                                            </x-dropdown.menu>
                                        </x-dropdown>
                                    </x-table.td>
                                </x-table.tr>
                            </template>
                        </x-table.tbody>
                    </x-table>
                </x-card.content>
            </x-card>
        </template>
        <template x-if="!products.length">
            <x-empty>
                <x-empty.message>No products found.</x-empty.message>
            </x-empty>
        </template>
        <x-confirm name="delete">
            <x-confirm.content>
                <x-confirm.header>
                    Delete Product
                </x-confirm.header>
                <x-confirm.body>
                    <p>Are you sure you want to delete <span class="font-bold" x-text="confirm.name"></span>?</p>
                </x-confirm.body>
                <x-confirm.footer>
                    <x-button x-on:click="handleDelete()" variant="danger" class="w-full md:w-auto">
                        <span x-show="confirm.loading">
                            <x-icon.loading/>
                        </span>
                        <span x-show="!confirm.loading">
                            Delete
                        </span>
                    </x-button>
                </x-confirm.footer>
            </x-confirm.content>
        </x-confirm>
    </x-module>
@endsection