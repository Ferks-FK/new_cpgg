<header
    class="flex justify-between items-center fixed top-0 z-50 w-[calc(100%-250px)] h-[60px] bg-gray-800 text-white p-2"
    x-bind:class="$store.layout.sidebar.open ? 'left-[250px] md:left-[250px]' : 'w-full left-0 md:w-[calc(100%-70px)] md:left-[70px]'"
>
    <div class="flex justify-between gap-2 items-center w-full">
        <div class="flex items-center gap-2">
            <div x-on:click="$store.layout.sidebar.toggle()" class="w-[35px] h-[35px] flex-grow-0 flex-shrink-0 flex justify-center items-center rounded-md border border-slate-600 cursor-pointer hover:border-slate-500">
                <x-icon.menu class='w-5 h-5' />
            </div>
            <ul class="hidden md:flex gap-3">
                <li>
                    <a href="#" class="text-white">Home</a>
                </li>
            </ul>
        </div>
        <ul class="flex gap-3">
            <li>
                <a href="{{ route('logout') }}" class="text-white">Logout</a>
            </li>
        </ul>
    </div>
</header>