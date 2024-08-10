@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="{{ route('home') }}">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item href="{{ route('shop') }}">Shop</x-breadcrumb.item>
        <x-breadcrumb.item href="{{ route('cart') }}">Cart</x-breadcrumb.item>
        <x-breadcrumb.item href="#">Checkout</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="checkout()" x-init="setGatewaysData({{ json_encode($gateways) }})">
        <x-module.header>
            <x-module.title>Payment Gateways</x-module.title>
        </x-module.header>
        <template x-if="!gateways.length">
            <x-empty>
                <x-empty.message>No payment gateways available.</x-empty.message>
            </x-empty>
        </template>
        <template x-if="gateways.length">
            <div class="flex items-center gap-5">
                <template x-for="gateway in gateways" :key="gateway.id">
                    <a href="#" x-on:click="handleCheckout(gateway.type)" class="flex w-1/4">
                        <x-card>
                            <x-card.content>
                                <img x-bind:src="gateway.image" x-bind:alt="gateway.name" class="max-h-14"/>
                            </x-card.content>
                        </x-card>
                    </a>
                </template>
            </div>
        </template>
    </x-module>
@endsection
