@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item href="#">Servers</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module>
        <x-module.header>
            <x-module.title>Servers</x-module.title>
            <x-module.options>
                <x-module.create href="#"/>
            </x-module.options>
        </x-module.header>
        @if ($servers->count())
            <x-card>
                <x-card.content>
                    <x-table>
                        <x-table.thead>
                            <x-table.tr>
                                <x-table.th>Status</x-table.th>
                                <x-table.th>Name</x-table.th>
                                <x-table.th>User</x-table.th>
                                <x-table.th>Server ID</x-table.th>
                                <x-table.th>Config</x-table.th>
                                <x-table.th>Suspended At</x-table.th>
                                <x-table.th>Created At</x-table.th>
                                <x-table.th></x-table.th>
                            </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @foreach ($servers as $server)
                                <x-table.tr>
                                    <x-table.td>
                                        <div class="size-[20px] rounded-full {{ $server->suspended ? 'bg-red-500' : 'bg-emerald-500' }}"></div>
                                    </x-table.td>
                                    <x-table.td>{{ $server->name }}</x-table.td>
                                    <x-table.td>{{ $server->user->first_name }}</x-table.td>
                                    <x-table.td>{{ $server->identifier }}</x-table.td>
                                    <x-table.td>{{ $server->product->description }}</x-table.td>
                                    <x-table.td>{{ $server->suspended_at }}</x-table.td>
                                    <x-table.td>{{ $server->created_at }}</x-table.td>
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
                <x-empty.message>No servers found.</x-empty.message>
            </x-empty>
        @endif
    </x-module>
@endsection