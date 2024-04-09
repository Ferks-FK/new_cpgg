@props([
    'label' => '',
    'route' => '',
    'icon' => '', 
    'size' => 'w-5 h-5 md:w-6 md:h-6',
    'active' => false
])

<li>
    <a
        href="{{ $route ? $route : 'javascript:void' }}"
        x-bind:class="$store.layout.sidebar.open && $store.breakpoints.mdAndUp ? 'w-full px-2' : 'md:w-[48px] justify-center'" 
        class="flex items-center gap-2 w-full py-2 px-3 rounded-md hover:bg-gray-600 {{ $active ? 'bg-gray-600' : '' }}"
    >
        <x-dynamic-component :component="$icon"/>
        <div
            x-bind:class="!$store.layout.sidebar.open && 'hidden'"
            x-transition:enter.delay.150ms
            class="flex flex-1 items-center justify-between ml-2"
        >
            <span class="font-medium">
                {{ $label }}
            </span>
        </div>
    </a>
</li>