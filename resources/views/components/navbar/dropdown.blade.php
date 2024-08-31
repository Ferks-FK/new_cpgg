@props([
    'label' => '',
    'icon' => '',
    'size' => 'w-5 h-5 md:w-6 md:h-6',
    'active' => false
])

<div
    x-data="{ open: false }"
    x-init="{{ $active ? 'open = true' : '' }}"
    x-on:click="open = !open"
    x-bind:class="!$store.layout.sidebar.open && 'hidden'"
    class="cursor-pointer"
>
    <div class="relative flex items-center w-full gap-2 px-3 py-2 mb-2 rounded-md hover:bg-gray-600">
        <x-dynamic-component :component="$icon"/>
        <span class="ml-2 font-medium">{{ $label }}</span>
        <x-icon.chevron-up class="absolute right-1.5 transition-transform !size-4" x-bind:class="open ? '' : 'rotate-180'"/>
    </div>
    <div
        x-cloak
        x-show="open && $store.layout.sidebar.open"
        x-transition:enter="transition ease-in duration-150"
        x-transition:enter-start="transform translate-y-[-10px] opacity-0"
        x-transition:enter-end="transform translate-y-0 opacity-100"
        x-transition:leave="transition ease-out duration-150"
        x-transition:leave-start="transform translate-y-0 opacity-100"
        x-transition:leave-end="transform translate-y-[-10px] opacity-0"
        class="pl-1.5"
    >
        <div class="flex flex-col gap-1" x-on:click.stop>
            {{ $slot }}
        </div>
    </div>
</div>

<div
    x-data="{ open: false }"
    x-on:click.outside="open = false"
    x-bind:class="{
        'bg-gray-600': open || {{ $active ? 'true' : 'false' }},
        'hidden': $store.layout.sidebar.open
    }"
    class="rounded-md hover:bg-gray-600"
>
    <button type="button" x-on:click="open = !open" class="w-full px-3 py-2" x-ref="menu">
        <x-dynamic-component :component="$icon"/>
    </button>
    <div x-show="open" x-anchor.offset.15.right-start="$refs.menu" class="px-3 py-2 border rounded-md bg-slate-800 border-slate-500 min-w-[200px]">
        <div class="px-3 pb-2">
            <span class="font-medium">{{ $label }}</span>
        </div>
        {{ $slot }}
    </div>
    <div
        x-cloak
        x-show="open && $store.layout.sidebar.open"
        x-transition:enter="transition ease-in duration-150"
        x-transition:enter-start="transform translate-y-[-10px] opacity-0"
        x-transition:enter-end="transform translate-y-0 opacity-100"
        x-transition:leave="transition ease-out duration-150"
        x-transition:leave-start="transform translate-y-0 opacity-100"
        x-transition:leave-end="transform translate-y-[-10px] opacity-0"
        class="pl-1.5"
    >
        {{ $slot }}
    </div>
</div>
