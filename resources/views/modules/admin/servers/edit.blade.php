@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item icon="icon.servers" href="{{ route('admin.servers') }}">Servers</x-breadcrumb.item>
        <x-breadcrumb.item href="#">{{ $server->name }}</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="adminServers()" x-init="setServerData({{ json_encode($server) }}), setUsersData({{ json_encode($users) }})">
        <x-module.header>
            <x-module.title>Edit Server</x-module.title>
        </x-module.header>
        <x-card>
            <x-card.content>
                <x-form x-on:submit.prevent="handleUpdate()">
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <x-form.group>
                            <x-form.label for="name">Name</x-form.label>
                            <x-form.input x-model="form.data.name" id="name"/>
                            <x-form.error x-show="form.errors.name" x-text="form.errors.name"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="userId">User</x-form.label>
                            <x-select x-model="form.data.user_id" x-on:change="console.log($event.target.value, form.data.user_id)" id="userId">
                                <template x-for="user in users" :key="user.id">
                                    <option x-bind:value="user.id" x-bind:selected="form.data.user_id == user.id" x-text="user.username"></option>
                                </template>
                            </x-select>
                            <x-form.error x-show="form.errors.user_id" x-text="form.errors.user_id"/>
                        </x-form.group>
                    </div>
                    <x-form.footer>
                        <x-button type="submit">
                            <span x-show="!form.loading">
                                Update Server
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