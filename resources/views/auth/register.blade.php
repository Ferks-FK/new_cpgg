@extends('layouts.login')

@section('content')
    <x-module x-data="register()">
        <div class="flex flex-col border-t-[3px] border-blue-500 rounded py-5 px-3 bg-zinc-700 min-w-[350px] shadow-md">
            <a class="text-center text-5xl font-semibold hover:text-blue-400 mb-5" href="#">Company</a>
            <p class="text-center">Login to start your session</p>
            <x-form x-init="form.data" x-on:submit.prevent="handleRegister()">
                <x-form.group>
                    <x-form.label for="name">Name</x-form.label>
                    <x-form.input x-model="form.data.name" id="name"/>
                    <x-form.error x-show="form.errors.name" x-text="form.errors.name"/>
                </x-form.group>
                <x-form.group>
                    <x-form.label for="email">Email</x-form.label>
                    <x-form.input x-model="form.data.email" type="email" icon="icon.mail" id="email"/>
                    <x-form.error x-show="form.errors.email" x-text="form.errors.email"/>
                </x-form.group>
                <x-form.group>
                    <x-form.label for="password">Password</x-form.label>
                    <x-form.input x-model="form.data.password" type="password" icon="icon.lock" id="password"/>
                    <x-form.error x-show="form.errors.password" x-text="form.errors.password"/>
                </x-form.group>
                <x-form.group>
                    <x-form.label for="confirmPassword">Confirm Password</x-form.label>
                    <x-form.input x-model="form.data.password_confirmation" type="password" icon="icon.lock" id="confirmPassword"/>
                    <x-form.error x-show="form.errors.password_confirmation" x-text="form.errors.password_confirmation"/>
                </x-form.group>
                <x-button>
                    <span>Register</span>
                </x-button>
                <a href="{{ route('login.view') }}" class="text-sm font-medium text-zinc-400 hover:text-zinc-300">I already have a membership</a>
            </x-form>
        </div>
    </x-module>
@endsection