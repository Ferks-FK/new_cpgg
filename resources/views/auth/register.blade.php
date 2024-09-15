@extends('layouts.login')

@section('content')
    <x-module x-data="register()">
        <div class="flex flex-col gap-5 border-t-[3px] border-blue-500 rounded py-5 px-3 bg-zinc-700 min-w-[350px] shadow-md">
            <h1 class="text-lg text-center">Register a new membership</h1>
            <x-form x-init="form.data" x-on:submit.prevent="handleRegister()">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <x-form.group>
                        <x-form.label for="firstName">Name</x-form.label>
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
                    <x-form.input x-model="form.data.email" type="email" id="email"/>
                    <x-form.error x-show="form.errors.email" x-text="form.errors.email"/>
                </x-form.group>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <x-form.group>
                        <x-form.label for="password">Password</x-form.label>
                        <x-form.input x-model="form.data.password" type="password" id="password"/>
                        <x-form.error x-show="form.errors.password" x-text="form.errors.password"/>
                    </x-form.group>
                    <x-form.group>
                        <x-form.label for="confirmPassword">Confirm Password</x-form.label>
                        <x-form.input x-model="form.data.password_confirmation" type="password" id="confirmPassword"/>
                        <x-form.error x-show="form.errors.password_confirmation" x-text="form.errors.password_confirmation"/>
                    </x-form.group>
                </div>
                <x-button>
                    <span>Register</span>
                </x-button>
                <a href="{{ route('login.view') }}" class="text-sm font-medium text-zinc-400 hover:text-zinc-300">I already have a membership</a>
            </x-form>
        </div>
    </x-module>
@endsection
