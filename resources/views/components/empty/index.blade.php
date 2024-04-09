@props([
    'icon' => null
])

<div class="flex items-center justify-center gap-2 mt-10 text-zinc-400">
    @if($icon)
        <x-dynamic-component :component="$icon" class="w-5 h-5" />
    @else
        <x-icon.alert class="w-5 h-5" />
    @endif
    {{ $slot }}
</div>
