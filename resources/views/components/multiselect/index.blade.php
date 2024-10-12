<div
    x-data="{
        isOpen: false,
        selectedOptions: [],

        init() {
            this.$watch('selectedOptions', values => {
                this.$dispatch('multiselect-updated', {
                    id: $el.getAttribute('id'),
                    values: values
                });
            });
        },

        addOption(name, value) {
            if (!this.selectedOptions.some(option => option.value == value)) {
                this.selectedOptions.push({ name: name, value: value });
            }
        },

        removeOption(option) {
            this.selectedOptions = this.selectedOptions.filter(opt => opt.value != option.value);
        },
    }"
    id="{{ $attributes->get('id') }}"
    x-on:click.away="isOpen = false"
    x-on:keydown.escape.window="isOpen = false"
    x-on:multiselect-set.window="if($event.detail.id == $el.getAttribute('id')) selectedOptions = $event.detail.values"
>
    <div class="relative select-none">
        <div x-ref="multiselect" x-on:click="isOpen = !isOpen" class="flex items-center h-auto gap-1 px-2 py-1 border rounded-md cursor-pointer min-h-10 focus-visible:border-zinc-400/70 focus-visible:outline-none focus-visible:border-blue-300 border-zinc-400">
            <span x-show="selectedOptions.length === 0">Select...</span>
            <div class="flex items-center justify-between w-full">
               <div class="flex flex-wrap gap-1">
                    <template x-for="(option, index) in selectedOptions" :key="index">
                        <div class="flex items-center w-auto gap-1 px-2 bg-blue-400 rounded-md min-h-3">
                            <span class="inline-block" x-text="option.name"></span>
                            <svg x-on:click.stop="removeOption(option)" xmlns="http://www.w3.org/2000/svg" class="size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </div>
                    </template>
               </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="hidden md:inline-block size-4 text-zinc-500" viewBox="0 0 20 20" fill="currentColor" class="inline-block w-4 h-4 ml-1 align-middle">
                    <path fill-rule="evenodd" d="M10 12a1 1 0 0 1-.707-.293l-4-4a1 1 0 1 1 1.414-1.414L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-.707.293z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
        <div x-show="isOpen" x-anchor.offset.5="$refs.multiselect" class="z-50 flex flex-col w-full gap-1 px-3 py-2 border rounded shadow-lg border-slate-500 bg-slate-600">
            {{ $slot }}
        </div>
    </div>
</div>
