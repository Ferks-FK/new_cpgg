@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item icon="icon.users" href="#">Users</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="adminUsers()" x-init="setUsersData({{ json_encode($users) }})">
        <x-module.header>
            <x-module.title>Users</x-module.title>
            <x-module.options>
                <x-module.create href="{{ route('admin.users.create') }}"/>
            </x-module.options>
        </x-module.header>
        <template x-if="users.length">
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
                            <template x-for="user in users" :key="user.id">
                                <x-table.tr>
                                    <x-table.td>
                                        <span x-text="user.id"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="user.username"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="user.email"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="user.credits"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="user.servers.length"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="user.email_verified_at"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="user.created_at"></span>
                                    </x-table.td>
                                    <x-table.td class="flex justify-end">
                                        <x-dropdown>
                                            <x-dropdown.trigger>
                                                <x-icon.more-vertical/>
                                            </x-dropdown.trigger>
                                            <x-dropdown.menu>
                                                <x-dropdown.item x-bind:href="`/admin/users/edit/${user.id}`">Edit</x-dropdown.item>
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
        <template x-if="!users.length">
            <x-empty>
                <x-empty.message>No users found.</x-empty.message>
            </x-empty>
        </template>
        <x-confirm name="delete">
            <x-confirm.content>
                <x-confirm.header>
                    Delete User
                </x-confirm.header>
                <x-confirm.body>
                    <p>Are you sure you want to delete <span class="font-bold" x-text="confirm.name"></span>?</p>
                    <p class="text-sm font-bold">All servers of this user will be deleted!</p>
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
