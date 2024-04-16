<header class="px-4 sm:px-6 sm:flex sm:items-start">
    <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
        <x-icon.warning class="text-red-500 !size-6"/>
    </div>
    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
        <h3 class="text-xl font-medium leading-6" id="modal-headline">{{ $slot }}</h3>
    </div>
</header>