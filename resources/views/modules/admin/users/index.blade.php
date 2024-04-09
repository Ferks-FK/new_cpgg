@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item href="#">Users</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module>
        <x-module.header>
            <x-module.title>Users</x-module.title>
            <x-module.options>
                <x-module.create href="#"/>
            </x-module.options>
        </x-module.header>
        @if ($users->count())
            <x-card>
                <x-card.content>
                    <x-table>
                        <x-table.thead>
                            <x-table.tr>
                                <x-table.th>Id</x-table.th>
                                <x-table.th>Username</x-table.th>
                                <x-table.th>Email</x-table.th>
                                <x-table.th>Credits</x-table.th>
                                <x-table.th>Servers</x-table.th>
                                <x-table.th>Verified</x-table.th>
                                <x-table.th>Credated At</x-table.th>
                                <x-table.th></x-table.th>
                            </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @foreach ($users as $user)
                                <x-table.tr>
                                    <x-table.td>{{ $user->id }}</x-table.td>
                                    <x-table.td>{{ $user->first_name . ' ' . $user->last_name }}</x-table.td>
                                    <x-table.td>{{ $user->email }}</x-table.td>
                                    <x-table.td>{{ $user->credits }}</x-table.td>
                                    <x-table.td>{{ $user->servers->count() }}</x-table.td>
                                    <x-table.td>{{ $user->email_verified_at }}</x-table.td>
                                    <x-table.td>{{ $user->created_at }}</x-table.td>
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
                <x-empty.message>No users found.</x-empty.message>
            </x-empty>
        @endif
    </x-module>
@endsection