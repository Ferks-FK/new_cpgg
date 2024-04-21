<div
    x-data="{ showModal: false }"
    x-on:confirm.window="
        if ($event.detail === '{{ $attributes->get('name') }}') {
            showModal = !showModal
        } else {
            showModal = false
        }
    ">
    <div x-show="showModal" class="fixed inset-0 z-50 transition-opacity" aria-hidden="true" x-on:click="showModal = false">
        <div class="absolute inset-0 opacity-75 bg-black/70"></div>
    </div>
    {{ $slot }}
</div>
