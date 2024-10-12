@props([
    'close' => true,
])

<div
    x-data="{ open: false, close: {{ $close }}}"
    x-on:modal.window="
        if ($event.detail === '{{ $attributes->get('name') }}') {
            open = !open
        } else {
            open = false
        }
    "
>
    <div x-cloak x-show="open" class="fixed inset-0 z-50 transition-opacity" aria-hidden="true" x-on:click="showModal = false">
        <div class="absolute inset-0 opacity-75 bg-black/70"></div>
    </div>
    {{ $slot }}
</div>
