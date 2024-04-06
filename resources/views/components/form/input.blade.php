@props([
    'icon' => '',
])

@if ($icon)
    <div class="flex">
        <input {{ $attributes->merge(['class' => 'w-full h-10 px-3 py-2 bg-transparent focus-visible:border-zinc-400/70 focus-visible:outline-none focus-visible:border-blue-300 border border-zinc-400 rounded-tl-md rounded-bl-md']) }}/>
        <div class="border border-l-0 border-zinc-400 py-2 px-3">
            <x-dynamic-component :component="$icon"/>
        </div>
    </div>
@else
    <input {{ $attributes->merge(['class' => 'w-full h-10 px-3 py-2 bg-transparent focus-visible:border-zinc-400/70 focus-visible:outline-none focus-visible:border-blue-300 border border-zinc-400 rounded-md']) }} />
@endif

