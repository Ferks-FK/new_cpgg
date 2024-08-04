<option
    x-data="{
        name: {{ $attributes->get('x-bind:name') ?? 'null' }},
        value: {{ $attributes->get('x-bind:value') ?? 'null' }},

        init() {
            if (selected.includes(this.value)) {
                addOption(this.name, this.value)
            }
        }
    }"
    {{ $attributes->merge(['class' => 'block p-1 text-sm rounded-sm cursor-pointer hover:bg-slate-700/50']) }}
    x-bind:class="{ 'bg-slate-800/30 hover:bg-slate-800/40': selected.includes(value) }"
    x-on:click="selected.includes(value) ? removeOption(name, value) : addOption(name, value)"
>
    <span x-text="name"></span>
</option>
