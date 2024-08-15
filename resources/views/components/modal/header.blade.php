<header class="flex items-center justify-between w-full px-4 pt-5 pb-5">
    <h2 class="text-xl font-bold leading-6">{{ $slot }}</h3>
    <template x-if="close">
        <button x-on:click="open = false" class="p-1 transition-colors rounded-md hover:bg-slate-500">
            <x-icon.close class="w-6 h-6" />
        </button>
    </template>
</header>
