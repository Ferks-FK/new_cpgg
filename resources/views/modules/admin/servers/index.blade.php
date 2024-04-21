@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item href="#">Servers</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="adminServers()" x-init="setServersData({{ json_encode($servers) }})">
        <x-module.header>
            <x-module.title>Servers</x-module.title>
        </x-module.header>
        <template x-if="servers.length">
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
                            <template x-for="server in servers" :key="server.id">
                                <x-table.tr>
                                    <x-table.td>
                                        <div
                                            class="size-[20px] rounded-full"
                                            x-bind:class="{ 'bg-red-500': server.suspended, 'bg-emerald-500': !server.suspended }"
                                        ></div>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="server.name"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="server.user.username"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="server.identifier"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="server.product.description"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="server.suspended_at"></span>
                                    </x-table.td>
                                    <x-table.td>
                                        <span x-text="server.created_at"></span>
                                    </x-table.td>
                                    <x-table.td class="flex justify-end">
                                        <x-dropdown>
                                            <x-dropdown.trigger>
                                                <x-icon.more-vertical/>
                                            </x-dropdown.trigger>
                                            <x-dropdown.menu>
                                                <x-dropdown.item x-bind:href="`/admin/servers/edit/${server.id}`">Edit</x-dropdown.item>
                                                <template x-if="!server.suspended">
                                                    <x-dropdown.item href="#" background="warning" x-on:click="handleConfirm('suspend')">Suspend</x-dropdown.item>
                                                </template>
                                                <template x-if="server.suspended">
                                                    <x-dropdown.item href="#" background="success" x-on:click="handleConfirm('unsuspend')">Unsuspend</x-dropdown.item>
                                                </template>
                                                <x-dropdown.divider/>
                                                <x-dropdown.item href="#" x-on:click="handleConfirm('delete')" background="danger">Delete</x-dropdown.item>
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
        <template x-if="!servers.length">
            <x-empty>
                <x-empty.message>No servers found.</x-empty.message>
            </x-empty>
        </template>
        <x-confirm name="delete">
            <x-confirm.content>
                <x-confirm.header>
                    Delete Server
                </x-confirm.header>
                <x-confirm.body>
                    <p>Are you sure you want to delete <span class="font-bold" x-text="confirm.name"></span>?</p>
                    <p class="text-sm font-bold">All server data on the pterodactyl will be deleted!</p>
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
        <x-confirm name="suspend">
            <x-confirm.content>
                <x-confirm.header>
                    Suspend Server
                </x-confirm.header>
                <x-confirm.body>
                    <p>Are you sure you want to suspend <span class="font-bold" x-text="confirm.name"></span>?</p>
                </x-confirm.body>
                <x-confirm.footer>
                    <x-button x-on:click="handleSuspend()" variant="danger" class="w-full md:w-auto">
                        <span x-show="confirm.loading">
                            <x-icon.loading/>
                        </span>
                        <span x-show="!confirm.loading">
                            Suspend
                        </span>
                    </x-button>
                </x-confirm.footer>
            </x-confirm.content>
        </x-confirm>
        <x-confirm name="unsuspend">
            <x-confirm.content>
                <x-confirm.header>
                    Unsuspend Server
                </x-confirm.header>
                <x-confirm.body>
                    <p>Are you sure you want to unsuspend <span class="font-bold" x-text="confirm.name"></span>?</p>
                </x-confirm.body>
                <x-confirm.footer>
                    <x-button x-on:click="handleUnsuspend()" variant="danger" class="w-full md:w-auto">
                        <span x-show="confirm.loading">
                            <x-icon.loading/>
                        </span>
                        <span x-show="!confirm.loading">
                            Unsuspend
                        </span>
                    </x-button>
                </x-confirm.footer>
            </x-confirm.content>
        </x-confirm>
    </x-module>
@endsection