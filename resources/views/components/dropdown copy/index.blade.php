<div x-data="usePopper({ placement: 'bottom-end', offset: 4 })" x-on:click.outside="if(isShowPopper) isShowPopper = false" class="relative">
    {{ $slot }}
</div>
