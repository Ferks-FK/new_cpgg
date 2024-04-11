@extends('layouts.default')

@section('content')
    <x-breadcrumb>
        <x-breadcrumb.item icon="icon.home" href="#">Dashboard</x-breadcrumb.item>
        <x-breadcrumb.item href="#">Servers</x-breadcrumb.item>
        <x-breadcrumb.item href="#">Create Server</x-breadcrumb.item>
    </x-breadcrumb>
    <x-module x-data="servers()" x-init="setNestsData({{ json_encode($nests) }}); setLocationsData({{ json_encode($locations) }}); setProductsData({{ json_encode($products) }})">
        <x-module.header>
            <x-module.title>Create Server</x-module.title>
        </x-module.header>
        <x-card class="!p-0">
            <x-card.content>
                <div class="size-full rounded-md">
                    <div class="border-b border-slate-500 py-4 px-4 mb-5">
                        <h1>Create Server</h1>
                    </div>
                    <x-form class="px-4">
                        <x-form.group>
                            <x-form.label for="name">Name</x-form.label>
                            <x-form.input x-model="form.data.name" id="name"/>
                        </x-form.group>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <x-form.group>
                                <x-form.label for="nest">Software / Game</x-form.label>
                                <x-select x-model="form.data.nest_id" x-on:change="getEggsByNestId($event.target.value)" id="nest">
                                    <option value="">Select...</option>
                                    <template x-for="nest in nests" :key="nest.id">
                                        <option x-bind:value="nest.id" x-text="nest.name"></option>
                                    </template>
                                </x-select>
                            </x-form.group>
                            <x-form.group>
                                <x-form.label for="egg">Software / Game Type</x-form.label>
                                <x-select
                                    x-model="form.data.egg_id"
                                    x-bind:class="eggs.length ? 'cursor-pointer' : 'cursor-not-allowed'"
                                    x-bind:disabled="!eggs.length"
                                    x-ref="egg"
                                    id="egg"
                                >
                                    <option value="">Select...</option>
                                    <template x-for="egg in eggs" :key="egg.id">
                                        <option x-bind:value="egg.id" x-text="egg.name"></option>
                                    </template>
                                </x-select>
                            </x-form.group>
                        </div>
                        <x-form.group>
                            <x-form.label for="node">Node</x-form.label>
                            <x-select
                                x-bind:class="form.data.nest_id && form.data.egg_id ? 'cursor-pointer' : 'cursor-not-allowed'"
                                x-bind:disabled="!form.data.nest_id || !form.data.egg_id"
                                x-model="form.data.node_id"
                                x-on:change="CheckResourcesByNodeId()"
                                id="node"
                            >
                                <option value="">Select...</option>
                                <template x-for="location in locations" :key="location.id">
                                    <option x-bind:value="location.node_data.id" x-text="location.name"></option>
                                </template>
                            </x-select>
                        </x-form.group>
                    </x-form>
                </div>
            </x-card.content>
        </x-card>
        <div x-show="form.data.node_id && products.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 self-center md:self-auto mt-5 gap-5">
            <template x-for="product in products" :key="product.id">
                <x-card class="min-w-[350px] !p-0">
                    <x-card.content class="h-full">
                        <div class="flex flex-col justify-between size-full rounded-md">
                            <div class="border-b border-slate-500">
                                <div class="border-b border-slate-500 py-4 px-2">
                                    <h1 x-text="product.name"></h1>
                                </div>
                                <div class="flex flex-col gap-1 p-4">
                                    <ul>
                                        <li class="flex justify-between">
                                            <div class="flex gap-1 items-center">
                                                <div>
                                                    <x-icon.cpu/>
                                                </div>
                                                <p>CPU</p>
                                            </div>
                                            <span x-text="product.cpu + ' vCores'"></span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex gap-1 items-center">
                                                <div>
                                                    <x-icon.memory/>
                                                </div>
                                                <p>Memory</p>
                                            </div>
                                            <span x-text="product.memory + ' MB'"></span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex gap-1 items-center">
                                                <div>
                                                    <x-icon.disk/>
                                                </div>
                                                <p>Disk</p>
                                            </div>
                                            <span x-text="product.disk + ' MB'"></span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex gap-1 items-center">
                                                <div>
                                                    <x-icon.save/>
                                                </div>
                                                <p>Backups</p>
                                            </div>
                                            <span x-text="product.backups"></span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex gap-1 items-center">
                                                <div>
                                                    <x-icon.database/>
                                                </div>
                                                <p>Databases</p>
                                            </div>
                                            <span x-text="product.databases">1</span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex gap-1 items-center">
                                                <div>
                                                    <x-icon.network/>
                                                </div>
                                                <p>Allocations</p>
                                            </div>
                                            <span x-text="product.allocations"></span>
                                        </li>
                                        <li class="flex justify-between">
                                            <div class="flex gap-1 items-center">
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
                            <div class="flex flex-col gap-2 py-4 px-2">
                                <div x-show="product.is_installable" class="flex flex-col gap-2">
                                    <div class="flex justify-between p-2 border border-slate-500 rounded-md">
                                        <span>Price:</span>
                                        <span x-text="product.price + ' Credits'"></span>
                                    </div>
                                    <x-button size="lg" x-on:click="handleProduct(product.id)">Create Server</x-button>
                                </div>
                                <div x-show="!product.is_installable" class="flex items-center w-full border border-red-500 bg-red-500 rounded-md py-4 px-2">
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