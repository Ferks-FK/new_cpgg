@props([
    'background' => 'default',
    'backgrounds' => [
        'default' => 'hover:bg-slate-600',
        'success' => 'hover:bg-emerald-500 text-white',
        'warning' => 'hover:bg-yellow-500 text-white',
        'danger' => 'hover:bg-red-500 text-white',
    ]
])

<a {{ $attributes->merge(['class' => "flex items-center w-full gap-2 px-2 py-1.5 rounded-md transition-colors {$backgrounds[$background]}"]) }}>
    {{ $slot }}
</a>
