@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item href="{{ route('servers') }}">Servers</x-breadcrumb.item>
        <x-breadcrumb.item href="#">Create Server</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="servers()" x-init="setEggsData({{ json_encode($eggs) }}); setNodesData({{ json_encode($nodes) }}); setProductsData({{ json_encode($products) }})">
        <x-module.header>
            <x-module.title>Create Server</x-module.title>
        </x-module.header>
        <x-card class="!p-0">
            <x-card.content>
                <div class="rounded-md size-full">
                    <div class="px-4 py-4 mb-5 border-b border-slate-500">
                        <h1>Create Server</h1>
                    </div>
                    <x-form class="px-4">
                        <x-form.group>
                            <x-form.label for="name">Name</x-form.label>
                            <x-form.input x-model="form.data.name" id="name"/>
                            <x-form.error x-show="form.errors.name" x-text="form.errors.name"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="egg">Software / Game</x-form.label>
                            <x-select x-model="form.data.egg_id" x-on:change="getProductByEggId()" id="egg">
                                <option value="">Select...</option>
                                <template x-for="egg in eggs" :key="egg.id">
                                    <option x-bind:value="egg.id" x-text="egg.name"></option>
                                </template>
                            </x-select>
                            <x-form.error x-show="form.errors.egg_id" x-text="form.errors.egg_id"/>
                        </x-form.group>
                        <x-form.group>
                            <x-form.label for="node">Node</x-form.label>
                            <x-select
                                x-bind:class="form.data.egg_id && form.data.egg_id ? 'cursor-pointer' : 'cursor-not-allowed'"
                                x-bind:disabled="!form.data.egg_id || !form.data.egg_id"
                                x-model="form.data.node_id"
                                x-on:change="CheckResourcesByNodeId()"
                                id="node"
                            >
                                <option value="">Select...</option>
                                <template x-for="node in nodes" :key="node.id">
                                    <option x-bind:value="node.id" x-text="node.name"></option>
                                </template>
                            </x-select>
                            <x-form.error x-show="form.errors.node_id" x-text="form.errors.node_id"/>
                        </x-form.group>
                    </x-form>
                </div>
            </x-card.content>
        </x-card>
        <div x-show="form.data.node_id && products.length" class="grid self-center grid-cols-1 gap-5 mt-5 md:grid-cols-2 lg:grid-cols-3 md:self-auto">
            <template x-for="product in products" :key="product.id">
                <x-card class="min-w-[350px] !p-0">
                    <x-card.content class="h-full">
                        <div class="flex flex-col justify-between rounded-md size-full">
                            <div class="border-b border-slate-500">
                                <div class="px-2 py-4 border-b border-slate-500">
                                    <h1 x-text="product.name"></h1>
                                </div>
                                <div class="flex flex-col gap-1 p-4">
                                    <ul>
                                        <li class="flex justify-between">
                                            <div class="flex items-center gap-1">
                                                <div>
                                                    <x-icon.cpu/>
                                                </div>
                                                <p>CPU</p>
                                            </div>
                                            <span x-text="product.cpu + ' vCores'"></span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex items-center gap-1">
                                                <div>
                                                    <x-icon.memory/>
                                                </div>
                                                <p>Memory</p>
                                            </div>
                                            <span x-text="product.memory + ' MB'"></span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex items-center gap-1">
                                                <div>
                                                    <x-icon.disk/>
                                                </div>
                                                <p>Disk</p>
                                            </div>
                                            <span x-text="product.disk + ' MB'"></span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex items-center gap-1">
                                                <div>
                                                    <x-icon.save/>
                                                </div>
                                                <p>Backups</p>
                                            </div>
                                            <span x-text="product.backups"></span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex items-center gap-1">
                                                <div>
                                                    <x-icon.database/>
                                                </div>
                                                <p>Databases</p>
                                            </div>
                                            <span x-text="product.databases">1</span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex items-center gap-1">
                                                <div>
                                                    <x-icon.network/>
                                                </div>
                                                <p>Allocations</p>
                                            </div>
                                            <span x-text="product.allocations"></span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex items-center gap-1">
                                                <div>
                                                    <x-icon.coins/>
                                                </div>
                                                <p>Required Credits</p>
                                            </div>
                                            <span x-text="product.minimum_credits == -1 ? 50 : product.minimum_credits"></span>
                                        </li>
                                    </ul>
                                    <div class="my-2">
                                        <span x-text="product.description"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 px-2 py-4">
                                <div x-show="product.is_installable" class="flex flex-col gap-2">
                                    <div class="flex justify-between p-2 border rounded-md border-slate-500">
                                        <span>Price:</span>
                                        <span x-text="product.price + ' Credits'"></span>
                                    </div>
                                    <x-button size="lg" x-on:click="handleProduct(product.id)">Create Server</x-button>
                                </div>
                                <div x-show="!product.is_installable" class="flex items-center w-full px-2 py-4 bg-red-500 border border-red-500 rounded-md">
                                    <span>The chosen node does not meet the requirements of this product.</span>
                                </div>
                            </div>
                        </div>
                    </x-card.content>
                </x-card>
            </template>
        </div>
    </x-module>
@endsection