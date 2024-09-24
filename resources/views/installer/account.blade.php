@extends('layouts.installer')

@section('content')
    <div class="flex flex-col gap-5">
        <div class="w-full px-6 py-3 border rounded-md border-slate-500">
            <h2 class="mb-1 text-xl font-semibold">Please enter your account information below.</h2>
            <p class="text-sm">
                If this account already exists in {{ setting('panel') }}, it will be used.<br>
                Please note that the password you enter here does not necessarily have to be the same as in {{ setting('panel') }}.
            </p>
        </div>
        <x-form id="account" x-on:submit.prevent="handleAccount()">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <x-form.group>
                    <x-form.label for="firstName">First Name</x-form.label>
                    <x-form.input x-model="form.account.data.first_name" x-on:input="form.account.errors.first_name = null" id="firstName"/>
                    <x-form.error x-show="form.account.errors.first_name" x-text="form.account.errors.first_name"/>
                </x-form.group>
                <x-form.group>
                    <x-form.label for="lastName">Last Name</x-form.label>
                    <x-form.input x-model="form.account.data.last_name" x-on:input="form.account.errors.last_name = null" id="lastName"/>
                    <x-form.error x-show="form.account.errors.last_name" x-text="form.account.errors.last_name"/>
                </x-form.group>
            </div>
            <x-form.group>
                <x-form.label for="email">Email</x-form.label>
                <x-form.input x-model="form.account.data.email" x-on:input="form.account.errors.email = null" id="email"/>
                <x-form.error x-show="form.account.errors.email" x-text="form.account.errors.email"/>
            </x-form.group>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <x-form.group>
                    <x-form.label for="password">Password</x-form.label>
                    <x-form.input type="password" x-model="form.account.data.password" x-on:input="form.account.errors.password = null" id="password"/>
                    <x-form.error x-show="form.account.errors.password" x-text="form.account.errors.password"/>
                </x-form.group>
                <x-form.group>
                    <x-form.label for="passwordConfirmation">Confirm Password</x-form.label>
                    <x-form.input type="password" x-model="form.account.data.password_confirmation" x-on:input="form.account.errors.password_confirmation = null" id="passwordConfirmation"/>
                    <x-form.error x-show="form.account.errors.password_confirmation" x-text="form.account.errors.password_confirmation"/>
                </x-form.group>
            </div>
        </x-form>
        <div class="flex justify-between w-full gap-5">
            <x-button as="link" href="{{ route('install.enviroment') }}">
                Back
            </x-button>
            <x-button type="submit" form="account" class="w-fit">
                <span x-show="!form.account.loading">
                    Next
                </span>
                <span x-cloak x-show="form.account.loading">
                    <x-icon.loading/>
                </span>
            </x-button>
        </div>
    </div>
@endsection
