@props([
    'label' => '',
    'route' => '',
    'size' => 'w-5 h-5 md:w-6 md:h-6',
    'active' => false
])

<li>
    <a
        href="{{ $route ? $route : 'javascript:void' }}"
        class="flex items-center gap-2 w-full py-2 px-3 rounded-md hover:bg-gray-600 {{ $active ? 'bg-gray-600' : '' }}"
    >
        <template x-if="$store.layout.sidebar.open">
            <x-icon.move-right class="!size-4"/>
        </template>
        <div
            x-transition:enter.delay.150ms
            class="flex items-center justify-between flex-1"
        >
            <span>{{ $label }}</span>
            <x-icon.chevron-right class="!size-4" x-bind:class="!$store.layout.sidebar.open ? '' : 'hidden'"/>
        </div>
    </a>
</li>
