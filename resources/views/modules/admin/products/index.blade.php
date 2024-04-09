@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item href="#">Products</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module>
        <x-module.header>
            <x-module.title>Products</x-module.title>
            <x-module.options>
                <x-module.create href="#"/>
            </x-module.options>
        </x-module.header>
        @if ($products->count())
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
                            @foreach ($products as $product)
                                <x-table.tr>
                                    <x-table.td>{{ $product->id }}</x-table.td>
                                    <x-table.td>{{ $product->name }}</x-table.td>
                                    <x-table.td>{{ $product->description }}</x-table.td>
                                    <x-table.td>{{ $product->price }}</x-table.td>
                                    <x-table.td>{{ $product->memory }}</x-table.td>
                                    <x-table.td>{{ $product->disk }}</x-table.td>
                                    <x-table.td>{{ $product->cpu }}</x-table.td>
                                    <x-table.td>{{ $product->swap }}</x-table.td>
                                    <x-table.td>{{ $product->databases }}</x-table.td>
                                    <x-table.td>{{ $product->backups }}</x-table.td>
                                    <x-table.td>{{ $product->minimum_credits }}</x-table.td>
                                    <x-table.td>0</x-table.td>
                                    <x-table.td>{{ $product->created_at }}</x-table.td>
                                    <x-table.td class="flex justify-end">
                                        <x-dropdown>
                                            <x-dropdown.trigger>
                                                <x-icon.more-vertical/>
                                            </x-dropdown.trigger>
                                            <x-dropdown.menu>
                                                <x-dropdown.item href="#">Edit</x-dropdown.item>
                                                <x-dropdown.divider/>
                                                <x-dropdown.item href="#" background="danger">Delete</x-dropdown.item>
                                            </x-dropdown.menu>
                                        </x-dropdown>
                                    </x-table.td>
                                </x-table.tr>
                            @endforeach
                        </x-table.tbody>
                    </x-table>
                </x-card.content>
            </x-card>
        @else
            <x-empty>
                <x-empty.message>No products found.</x-empty.message>
            </x-empty>
        @endif
    </x-module>
@endsection