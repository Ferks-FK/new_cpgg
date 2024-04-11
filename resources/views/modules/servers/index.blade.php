@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item href="#">Servers</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module>
        <x-module.header>
            <x-module.title>Servers</x-module.title>
            <x-module.options>
                <x-module.create href="{{ route('servers.create') }}"/>
            </x-module.options>
        </x-module.header>
            <x-card class="max-w-[350px] !p-0">
                <x-card.content>
                    <div class="size-full rounded-md">
                        <div class="border-b border-slate-500 py-4 px-2">
                            <h1>Nome do servidor</h1>
                        </div>
                        <div class="flex flex-col gap-1 p-4">
                            <div class="flex mx-2">
                                <p class="w-full">Status:</p>
                                <p class="w-full">Online</p>
                            </div>
                            <div class="flex mx-2">
                                <p class="w-full">Location:</p>
                                <p class="w-full">Europe</p>
                            </div>
                            <div class="flex mx-2">
                                <p class="w-full">Software / Game:</p>
                                <p class="w-full">Counter-Strike: Global Offensive</p>
                            </div>
                            <div class="flex mx-2">
                                <p class="w-full">Specification:</p>
                                <p class="w-full">Vanilla Counter Strike</p>
                            </div>
                            <div class="flex mx-2">
                                <p class="w-full">Plan:</p>
                                <p class="w-full">Basic</p>
                            </div>
                            <div class="flex mx-2">
                                <p class="w-full">Price:</p>
                                <div class="flex gap-2 w-full">
                                    <div class="flex flex-col w-full">
                                        <p>Monthly:</p>
                                        <p>€ 10.00</p>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <p>Yearly:</p>
                                        <p>€ 100.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-slate-500 py-4 px-2">
                            <div class="flex gap-2 justify-center">
                                <x-button size="lg" class="">Manage</x-button>
                                <x-button size="lg" class="">Settings</x-button>
                            </div>
                        </div>
                    </div>
                </x-card.content>
            </x-card>
        {{-- @if ($servers->count())
            <x-card>
                <x-card.content>
                    <p>tete</p>
                </x-card.content>
            </x-card>
        @else
            <x-empty>
                <x-empty.message>You dont have servers.</x-empty.message>
            </x-empty>
        @endif --}}
    </x-module>
@endsection