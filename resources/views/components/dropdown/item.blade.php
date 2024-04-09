@props([
    'background' => 'default',
    'backgrounds' => [
        'default' => 'hover:bg-slate-600',
        'danger' => 'hover:bg-red-500 text-white',
    ]
])

<a {{ $attributes->merge(['class' => "flex items-center w-full gap-2 px-2 py-1.5 rounded-md transition-colors {$backgrounds[$background]}"]) }}>
    {{ $slot }}
</a>
