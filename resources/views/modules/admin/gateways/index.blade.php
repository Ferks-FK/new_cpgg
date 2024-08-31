@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item icon="icon.hand-coins" href="#">Gateways</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module>
        <x-module.header>
            <x-module.title>Gateways</x-module.title>
        </x-module.header>
        @if($gateways->isEmpty())
            <x-empty>
                <x-empty.message>No gateways have been added yet.</x-empty.message>
            </x-empty>
        @else
            <div class="flex gap-5">
                @foreach ($gateways as $gateway)
                    <div class="w-1/4 gap-5">
                        <div class="flex flex-col items-center justify-center p-2 rounded-md shadow-md bg-slate-600">
                            <img src="{{ $gateway->image }}" alt="{{ $gateway->name }}" class="mb-5 max-h-12"/>
                            <x-button as="link" href="{{ route('admin.gateways.edit', $gateway->type) }}" icon="icon.pencil" icon_size="!size-4">
                                Edit
                            </x-button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </x-module>
@endsection
