@props([
    'label' => '',
    'name' => '',
])

<div
    x-data="{
        switchOn: false,

        init() {
            if ({{ $attributes->get('x-bind:default') }}) {
                this.switchOn = true
            }
        }
    }"
>
    <input type="checkbox" name="{{ $name }}" class="hidden" x-model="switchOn">

    <div class="flex items-center gap-2">
        <button
            x-ref="switchButton"
            type="button"
            x-on:click="switchOn = ! switchOn; $dispatch('switch-change', switchOn)"
            x-bind:class="switchOn ? 'bg-blue-600' : 'bg-slate-400'"
            class="relative inline-flex h-6 py-0.5 focus:outline-none rounded-full w-10"
        >
            <span x-bind:class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'" class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
        </button>

        <label
            x-on:click="$refs.switchButton.click(); $refs.switchButton.focus()" x-bind:id="$id('switch')"
            class="text-sm select-none"
        >
            {{ $label }}
        </label>
    </div>
</div>
