@props([
    'title' => ''
])

<div class="flex flex-col gap-1">
    @if ($title)
        <li x-bind:class="!$store.layout.sidebar.open && 'h-[20px] mx-0 !my-0'" class="text-sm font-medium mt-5 mb-1 mx-3">
            <span x-bind:class="!$store.layout.sidebar.open && 'hidden'">{{ $title }}</span>
        </li>
    @endif
    {{ $slot }}
</div>