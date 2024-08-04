<option
    x-data="{
        value: {{ $attributes->get('x-bind:value') }},

        init() {
            if (selectedOptions.includes(this.value)) {
                this.$nextTick(() => {
                    addOption($el.innerText, this.value)
                });
            }
        }
    }"
    {{ $attributes->merge(['class' => 'block p-1 text-sm rounded-sm cursor-pointer hover:bg-slate-700/50']) }}
    x-bind:class="{ 'bg-slate-800/30 hover:bg-slate-800/40': selectedOptions.some(option => option.value === value) }"
    x-on:click="selectedOptions.some(option => option.value === value) ? removeOption({ name: $el.innerText, value: value }) : addOption($el.innerText, value)"
></option>
