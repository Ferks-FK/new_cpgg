<li {{ $attributes->merge(['class' => 'flex justify-center items-center gap-1 text-xs md:gap-2 group']) }}>
    <x-icon.chevron-right class="w-3 h-3 group-first:hidden" />
    @if($attributes->get('icon'))
        <x-dynamic-component :component="$attributes->get('icon')" class="hidden w-4 h-4 md:block" />
    @endif
    @if($attributes->get('icon') || $attributes->get('href'))
        <a class="flex items-center py-1 transition-colors hover:text-blue-500" href="{{ $attributes->get('href') }}">
            {{ $slot }}
        </a>
    @else
        <span class="flex items-center justify-center gap-3 font-bold text-zinc-700 dark:text-zinc-300">
            {{ $slot }}
        </span>
    @endif
</li>
