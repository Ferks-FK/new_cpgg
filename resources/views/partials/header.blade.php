<header
    class="flex justify-between items-center fixed top-0 z-50 w-[calc(100%-250px)] h-[60px] bg-gray-800 text-white p-2 border-b border-slate-600"
    x-bind:class="$store.layout.sidebar.open ? 'left-[250px] md:left-[250px]' : 'w-full left-0 md:w-[calc(100%-70px)] md:left-[70px]'"
>
    <div class="flex items-center justify-between w-full gap-2">
        <div class="flex items-center gap-2">
            <div x-on:click="$store.layout.sidebar.toggle()" class="w-[35px] h-[35px] flex-grow-0 flex-shrink-0 flex justify-center items-center rounded-md border border-slate-600 cursor-pointer hover:border-slate-500">
                <x-icon.menu class='w-5 h-5' />
            </div>
            <ul class="hidden gap-3 md:flex">
                <li>
                    <a href="#" class="text-white">Home</a>
                </li>
            </ul>
        </div>
        <ul class="flex gap-3">
            <x-dropdown>
                <x-dropdown.trigger class="hover:!bg-transparent">
                    <div class="size-[45px] flex items-center justify-center rounded-full border-[3px] border-slate-500 overflow-hidden bg-slate-700 cursor-pointer">
                        <x-icon.user class="!size-6"/>
                    </div>
                </x-dropdown.trigger>
                <x-dropdown.menu>
                    <x-dropdown.item href="#">
                        Profile
                    </x-dropdown.item>
                    <x-dropdown.item href="{{ route('logout') }}">
                        Logout
                    </x-dropdown.item>
                </x-dropdown.menu>
            </x-dropdown>
        </ul>
    </div>
</header>
