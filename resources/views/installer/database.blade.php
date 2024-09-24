@extends('layouts.installer')

@section('content')
    <div x-init="setDatabaseData({{ json_encode($database) }})" class="flex flex-col gap-5">
        <x-form id="database" x-on:submit.prevent="handleDatabase()">
            <x-form.group>
                <x-form.label for="databaseName">Database Name</x-form.label>
                <x-form.input x-model="form.database.data.database_name" id="databaseName"/>
                <x-form.error x-show="form.database.errors.database_name" x-text="form.database.errors.database_name"/>
            </x-form.group>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <x-form.group>
                    <x-form.label for="databaseHost">Database Host</x-form.label>
                    <x-form.input x-model="form.database.data.database_host" id="databaseHost"/>
                    <x-form.error x-show="form.database.errors.database_host" x-text="form.database.errors.database_host"/>
                </x-form.group>
                <x-form.group>
                    <x-form.label for="databasePort">Database Port</x-form.label>
                    <x-form.input x-model="form.database.data.database_port" id="databasePort"/>
                    <x-form.error x-show="form.database.errors.database_port" x-text="form.database.errors.database_port"/>
                </x-form.group>
            </div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <x-form.group>
                    <x-form.label for="databaseUser">Database User</x-form.label>
                    <x-form.input x-model="form.database.data.database_user" id="databaseUser"/>
                    <x-form.error x-show="form.database.errors.database_user" x-text="form.database.errors.database_user"/>
                </x-form.group>
                <x-form.group>
                    <x-form.label for="databasePassword">Database Password</x-form.label>
                    <x-form.input type="password" x-model="form.database.data.database_password" id="databasePassword"/>
                    <x-form.error x-show="form.database.errors.database_password" x-text="form.database.errors.database_password"/>
                </x-form.group>
            </div>
        </x-form>
        <div class="flex justify-between w-full gap-5">
            <x-button as="link" href="{{ route('install') }}">
                Back
            </x-button>
            <x-button type="submit" form="database" class="w-fit">
                <span x-show="!form.database.loading">
                    Next
                </span>
                <span x-cloak x-show="form.database.loading">
                    <x-icon.loading/>
                </span>
            </x-button>
        </div>
    </div>
@endsection
