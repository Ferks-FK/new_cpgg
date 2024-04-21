@props([
    'name' => null
])

<div
    x-data="{
        isOpen: false,
        selected: null,
        selectedNames: [],
        
        init() {
            this.selected = this.getValueByPath('{{ $name }}')

            console.log(this.selected)
        },

        getValueByPath(path) {
            console.log(path)
            let parts = path.split('.')
            let current = this;

            for (let part of parts) {
                if (current[part] === undefined) {
                    return undefined;
                }
                current = current[part];
            }

            return current;
        },

        addOption(name, value) {
            if (!this.selectedNames.includes(name)) {
                this.selectedNames.push(name);
            }

            if (!this.selected.includes(value)) {
                this.selected.push(value);
            }
        },

        removeOption(name, value) {
            this.selected.splice(this.selected.indexOf(value), 1);
            this.selectedNames.splice(this.selectedNames.indexOf(name), 1);
        },
    }"
    x-on:click.away="isOpen = false"
>
    <div class="relative">
        <div x-on:click="isOpen = !isOpen" class="flex items-center h-auto gap-1 px-2 py-1 border rounded-md cursor-pointer min-h-10 focus-visible:border-zinc-400/70 focus-visible:outline-none focus-visible:border-blue-300 border-zinc-400">
            <span x-show="selectedNames.length === 0">Select...</span>
            <div class="flex items-center justify-between w-full">
               <div class="flex flex-wrap gap-1">
                    <template x-for="(option, index) in selectedNames" :key="index">
                        <div class="flex items-center w-auto gap-1 px-2 bg-blue-400 rounded-md min-h-3">
                            <span class="inline-block" x-text="option"></span>
                            <svg x-on:click.stop="removeOption(option)" xmlns="http://www.w3.org/2000/svg" class="size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </div>
                    </template>
               </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="hidden md:inline-block size-4 text-zinc-500" viewBox="0 0 20 20" fill="currentColor" class="inline-block w-4 h-4 ml-1 align-middle">
                    <path fill-rule="evenodd" d="M10 12a1 1 0 0 1-.707-.293l-4-4a1 1 0 1 1 1.414-1.414L10 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-.707.293z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
        <div x-show="isOpen" class="absolute z-50 flex flex-col w-full gap-1 px-3 py-2 mt-1 border rounded shadow-lg border-slate-500 bg-slate-600">
            {{ $slot }}
        </div>
    </div>
</div>