@props([
    'size' => 'md',
    'sizes' => [
        'sm' => 'md:w-[350px]',
        'md' => 'md:w-[500px]',
        'lg' => 'md:w-[700px]',
        'xl' => 'md:w-[900px]',
    ]
])

<div
    x-cloak
    x-show="open"
    x-on:close.window="open = false"
    x-on:keydown.escape.window="if (close) open = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-hidden"
>
    <div class="flex items-center justify-center min-h-screen px-4 py-4 text-center">
        <div class="inline-block w-full overflow-hidden text-left align-bottom transition-all transform rounded-lg shadow-xl bg-slate-600 sm:my-8 sm:align-middle sm:w-full {{ $sizes[$size] }}" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-slate-600">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

