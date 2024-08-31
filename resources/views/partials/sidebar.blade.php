<div
    x-cloak
    class="fixed top-0 z-10 flex flex-col h-screen gap-2 bg-gray-800"
    x-bind:class="$store.layout.sidebar.open ? 'w-[250px]' : '-ml-[70px] md:ml-0 w-[70px]'"
>
    <div class="flex justify-center items-center py-3 px-2 border-b h-[60px] border-slate-600">
        Logo
    </div>
    <x-navbar>
        <x-navbar.group>
            <x-navbar.item route="{{ route('home') }}" label="Dashboard" icon="icon.home" active="{{ request()->is(['/']) }}"/>
            <x-navbar.item route="{{ route('servers') }}" label="Servers" icon="icon.servers" active="{{ request()->is(['servers', 'servers/*']) }}"/>
            <x-navbar.item route="{{ route('shop') }}" label="Shop" icon="icon.shopping-basket" active="{{ request()->is(['shop', 'shop/*', 'cart']) }}"/>
        </x-navbar.group>
        <x-navbar.group title="Administration">
            <x-navbar.item route="{{ route('admin.users') }}" label="Users" icon="icon.users" active="{{ request()->is(['admin/users', 'admin/users/*']) }}"/>
            <x-navbar.item route="{{ route('admin.servers') }}" label="Servers" icon="icon.servers" active="{{ request()->is(['admin/servers', 'admin/servers/*']) }}"/>
            <x-navbar.item route="{{ route('admin.products') }}" label="Products" icon="icon.sliders" active="{{ request()->is(['admin/products', 'admin/products/*']) }}"/>
            <x-navbar.item route="{{ route('admin.store') }}" label="Store" icon="icon.shopping-basket" active="{{ request()->is(['admin/store', 'admin/store/*']) }}"/>
            <x-navbar.item route="{{ route('admin.gateways') }}" label="Gateways" icon="icon.hand-coins" active="{{ request()->is(['admin/gateways', 'admin/gateways/*']) }}"/>
            <x-navbar.dropdown label="Settings" icon="icon.settings" active="{{ request()->is(['admin/settings', 'admin/settings/pterodactyl']) }}">
                <x-navbar.dropdown-item route="{{ route('admin.settings') }}" label="Global" active="{{ request()->is(['admin/settings']) }}"/>
                <x-navbar.dropdown-item route="{{ route('admin.settings.pterodactyl') }}" label="Pterodactyl" active="{{ request()->is(['admin/settings/pterodactyl', 'admin/settings/pterodactyl/*']) }}"/>
            </x-navbar.dropdown>
        </x-navbar.group>
    </x-navbar>
</div>
