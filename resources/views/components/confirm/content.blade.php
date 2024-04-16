<div
    x-cloak
    x-show="showModal"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    class="fixed inset-0 z-50 overflow-y-hidden"
>
    <div class="flex items-center justify-center min-h-screen px-4 py-4 text-center sm:p-0">
        <div class="inline-block w-full overflow-hidden text-left align-bottom transition-all transform rounded-lg shadow-xl bg-slate-600 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="pt-5 bg-slate-600">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>