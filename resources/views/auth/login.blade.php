@extends('layouts.login')

@section('content')
    <x-module x-data="login()">
        <div class="flex flex-col gap-5 border-t-[3px] border-blue-500 rounded py-5 px-3 bg-zinc-700 min-w-[350px] shadow-md">
            <h1 class="text-lg text-center">Login to start your session</h1>
            <x-form x-on:submit.prevent="handleLogin()">
                <x-form.group>
                    <x-form.label for="email">Email</x-form.label>
                    <x-form.input x-model="form.data.email" type="email" id="email"/>
                    <x-form.error x-show="form.errors.email" x-text="form.errors.email"/>
                </x-form.group>
                <x-form.group>
                    <x-form.label for="password">Password</x-form.label>
                    <x-form.input x-model="form.data.password" type="password" id="password"/>
                    <x-form.error x-show="form.errors.password" x-text="form.errors.password"/>
                </x-form.group>
                <div class="flex items-center gap-1">
                    <input x-model="form.data.remember" type="checkbox" class="border-none size-4" id="remember" />
                    <x-form.label for="remember" class="text-sm">Remember me</x-form.label>
                </div>
                <x-button>
                    <span>Login</span>
                </x-button>
                <div class="flex flex-col gap-2">
                    <a href="#" class="text-sm font-medium text-zinc-400 hover:text-zinc-300">Forgot your password?</a>
                    <a href="{{ route('register.view') }}" class="text-sm font-medium text-zinc-400 hover:text-zinc-300">Register a new membership</a>
                </div>
            </x-form>
        </div>
    </x-module>
@endsection
