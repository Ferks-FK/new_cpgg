@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="{{ route('home') }}">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item href="{{ route('shop') }}">Shop</x-breadcrumb.item>
        <x-breadcrumb.item href="#">Cart</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="cart()" x-init="setCartData({{ json_encode($cart) }})">
        <x-module.header>
            <x-module.title>Cart</x-module.title>
        </x-module.header>
        <x-card>
            <template x-if="cart && cart.items.length">
                <x-table>
                    <x-table.thead>
                        <x-table.tr>
                            <x-table.th>Name</x-table.th>
                            <x-table.th>Price</x-table.th>
                            <x-table.th>Quantity</x-table.th>
                            <x-table.th>Total</x-table.th>
                            <x-table.th></x-table.th>
                        </x-table.tr>
                        <x-table.tbody>
                            <template x-for="item in cart.items" :key="item.id">
                                <x-table.tr class="hover:!bg-transparent">
                                    <x-table.td class="!p-1.5">
                                        <span x-text="item.product.name"></span>
                                    </x-table.td>
                                    <x-table.td class="!p-1.5">
                                        <span x-text="item.product.price"></span>
                                    </x-table.td>
                                    <x-table.td class="!p-1.5">
                                        <x-form.input type="number" x-model="item.quantity" x-on:input.debounce="updateItem(item.store_product_id, item.quantity)" class="text-sm h-7 !w-fit"/>
                                    </x-table.td>
                                    <x-table.td class="!p-1.5">
                                        <span x-text="item.product.price * item.quantity"></span>
                                    </x-table.td>
                                    <x-table.td class="flex justify-end !p-1.5">
                                        <x-button variant="danger" size="icon" x-on:click="removeItem(item.id)">
                                            <x-icon.circle-x/>
                                        </x-button>
                                    </x-table.td>
                                </x-table.tr>
                            </template>
                        </x-table.tbody>
                    </x-table.thead>
                </x-table>
            </template>
            <template x-if="!cart">
                <x-empty>
                    <x-empty.message>Your cart is empty.</x-empty.message>
                </x-empty>
            </template>
            <div x-show="cart" class="flex items-center justify-between my-5">
                <div>
                    <x-button icon="icon.trash" variant="danger" x-on:click="clearCart()">
                        Clear Cart
                    </x-button>
                </div>
                <span>Total: $ <span x-text="total"></span>
            </div>
            <div class="flex items-center justify-between">
                <x-button as="link" icon="icon.move-left" href="{{ route('shop') }}" variant="secondary" x-on:click="continueShopping()">
                    Continue Shopping
                </x-button>
                <x-button x-show="cart" as="link" href="{{ route('checkout') }}" variant="primary">Checkout</x-button>
            </div>
        </x-card>
    </x-module>
@endsection
