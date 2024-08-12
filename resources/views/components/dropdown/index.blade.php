<div
    x-data="{ open: false }"
    x-on:click.outside="if(open) open = false"
>
    {{ $slot }}
</div>
