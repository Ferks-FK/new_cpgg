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
        @if ($servers->count())
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($servers as $server)
                    <x-card class="!p-0">
                        <x-card.content>
                            <div class="rounded-md size-full">
                                <div class="px-2 py-4 border-b border-slate-500">
                                    <h1>{{ $server['name'] }}</h1>
                                </div>
                                <div class="flex flex-col gap-1 p-4">
                                    <ul>
                                        <li class="flex justify-between">
                                            <p>Status:</p>
                                            <div class="size-[20px] rounded-full {{ $server['suspended'] ? 'bg-red-500' : 'bg-emerald-500' }}"></div>
                                        </li>
                                        <li class="flex justify-between">
                                            <p>Location:</p>
                                            <p>{{ $server['location'] }}</p>
                                        </li>
                                        <li class="flex justify-between">
                                            <p>Node:</p>
                                            <p>{{ $server['node'] }}</p>
                                        </li>
                                        <li class="flex justify-between">
                                            <p>Software / Game:</p>
                                            <p>{{ $server['nest'] }}</p>
                                        </li>
                                        <li class="flex justify-between">
                                            <p>Specification:</p>
                                            <p>{{ $server['egg'] }}</p>
                                        </li>
                                        <li class="flex justify-between">
                                            <p>Plan:</p>
                                            <p>{{ $server['product']['name'] }}</p>
                                        </li>
                                        <li class="flex justify-between">
                                            <p>Node:</p>
                                            <p>{{ $server['node'] }}</p>
                                        </li>
                                    </ul>
                                    <div class="flex">
                                        <p class="w-full">Price:</p>
                                        <div class="flex w-full gap-2 max-w-[200px]">
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
                                <div class="px-2 py-4 border-t border-slate-500">
                                    <div class="flex justify-center gap-2">
                                        <x-button size="lg" class="">Manage</x-button>
                                        <x-button size="lg" class="">Settings</x-button>
                                    </div>
                                </div>
                            </div>
                        </x-card.content>
                    </x-card>
                @endforeach
            </div>
        @else
            <x-empty>
                <x-empty.message>You dont have servers.</x-empty.message>
            </x-empty>
        @endif
    </x-module>
@endsection