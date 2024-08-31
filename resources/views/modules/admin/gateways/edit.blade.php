@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item icon="icon.hand-coins" href="{{ route('admin.gateways') }}">Gateways</x-breadcrumb.item>
        <x-breadcrumb.item href="#">{{ $gateway->name }}</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="gateways()" x-init="setGatewayData({{ json_encode($gateway) }})">
        <x-module.header>
            <x-module.title>Edit {{ $gateway->name }}</x-module.title>
        </x-module.header>
        <x-form x-on:submit.prevent="handleUpdate()">
            {!! $gateway->class !!}
            <x-form.footer>
                <x-button type="submit" class="!w-full md:!w-fit">
                    <span x-show="!form.loading">
                        Save
                    </span>
                    <span x-show="form.loading">
                        <x-icon.loading/>
                    </span>
                </x-button>
            </x-form.footer>
            <input x-ref="gateway" type="hidden" name="gateway" value="{{ $gateway->type }}">
        </x-form>
    </x-module>
@endsection
