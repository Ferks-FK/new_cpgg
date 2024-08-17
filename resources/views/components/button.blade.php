@props([
    'class' => '',
    'variant' => 'primary',
    'icon' => '',
    'icon_size' => 'size-5',
    'variants' => [
        'primary' => 'bg-blue-500 hover:bg-blue-600 text-white',
        'secondary' => 'bg-gray-500 hover:bg-gray-600 text-white',
        'success' => 'bg-emerald-500 hover:bg-emerald-600 text-white',
        'danger' => 'bg-red-500 hover:bg-red-600 text-white',
        'white' => 'bg-zinc-100 hover:bg-gray-200 text-gray-900',
    ],
    'size' => 'md',
    'sizes' => [
        'sm' => 'py-1 px-2 text-sm',
        'md' => 'py-2 px-3 text-base',
        'lg' => 'py-3 px-4 text-lg',
        'icon' => 'p-2',
    ],
    'shape' => 'default',
    'shapes' => [
        'square' => 'rounded-none',
        'default' => 'rounded-md',
        'rounded' => 'rounded-full',
    ],
    'as' => 'button',
])

@if ($as === 'button')
    <button {{ $attributes }} class="flex gap-2 justify-center items-center text-sm transition-colors font-medium focus-visible:outline-none focus-visible:ring-offset-2 dark:ring-offset-black ring-offset-white focus-visible:ring-2 disabled:opacity-50 disabled:cursor-not-allowed {{ $variants[$variant] }} {{ $sizes[$size] }} {{ $shapes[$shape] }} {{ $class }}">
        @if($icon)
            <span class="flex items-center justify-center gap-1">
                <x-dynamic-component :component="$icon" class="{{ $icon_size }}"/>
                {{ $slot }}
            </span>
        @else
            {{ $slot }}
        @endif
    </button>
@endif

@if ($as === 'link')
    <a {{ $attributes }} class="flex gap-2 justify-center items-center text-sm transition-colors font-medium focus-visible:outline-none focus-visible:ring-offset-2 dark:ring-offset-black ring-offset-white focus-visible:ring-2 disabled:opacity-50 disabled:cursor-not-allowed {{ $variants[$variant] }} {{ $sizes[$size] }} {{ $shapes[$shape] }} {{ $class }}">
        @if($icon)
            <span class="flex items-center justify-center gap-1">
                <x-dynamic-component :component="$icon" class="{{ $icon_size }}"/>
                {{ $slot }}
            </span>
        @else
            {{ $slot }}
        @endif
    </a>
@endif
