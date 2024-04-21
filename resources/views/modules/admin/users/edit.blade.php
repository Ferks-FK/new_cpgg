@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item icon="icon.users" href="{{ route('admin.users') }}">Users</x-breadcrumb.item>
        <x-breadcrumb.item href="#">{{ $user->username }}</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="adminUsers()" x-init="setUserData({{ json_encode($user) }})">
        <x-module.header>
            <x-module.title>Edit User</x-module.title>
        </x-module.header>
        <x-card>
            <x-card.content>
                <x-form x-on:submit.prevent="handleUpdate()">
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <x-form.group>
                            <x-form.label for="firstName">First Name</x-form.label>
                            <x-form.input x-model="form.data.first_name" id="firstName"/>
                            <x-form.error x-show="form.errors.first_name" x-text="form.errors.first_name"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="lastName">Last Name</x-form.label>
                            <x-form.input x-model="form.data.last_name" id="lastName"/>
                            <x-form.error x-show="form.errors.last_name" x-text="form.errors.last_name"/>
                        </x-form.group>
                    </div>
                    <x-form.group>
                        <x-form.label for="email">Email</x-form.label>
                        <x-form.input x-model="form.data.email" id="email"/>
                        <x-form.error x-show="form.errors.email" x-text="form.errors.email"/>
                    </x-form.group>
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <x-form.group>
                            <x-form.label for="credits">Credits</x-form.label>
                            <x-form.input x-model="form.data.credits" id="credits"/>
                            <x-form.error x-show="form.errors.credits" x-text="form.errors.credits"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="serverLimit">Server Limit</x-form.label>
                            <x-form.input x-model="form.data.server_limit" id="serverLimit"/>
                            <x-form.error x-show="form.errors.server_limit" x-text="form.errors.server_limit"/>
                        </x-form.group>
                    </div>
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <x-form.group>
                            <x-form.label for="password">Password</x-form.label>
                            <x-form.input type="password" x-model="form.data.password" id="password"/>
                            <x-form.error x-show="form.errors.password" x-text="form.errors.password"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="passwordConfirmation">Password Confirmation</x-form.label>
                            <x-form.input type="password" x-model="form.data.password_confirmation" id="passwordConfirmation"/>
                            <x-form.error x-show="form.errors.password_confirmation" x-text="form.errors.password_confirmation"/>
                        </x-form.group>
                    </div>
                    <x-form.footer>
                        <x-button type="submit">
                            <span x-show="!form.loading">
                                Update User
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