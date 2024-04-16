<div class="flex flex-col gap-2 px-4 py-3 bg-slate-500/10 sm:px-6 sm:flex-row-reverse">
    {{ $slot }}
    <x-button x-on:click="showModal = false" variant="white" class="w-full md:w-auto">
        Cancel
    </x-button>
</div>