<button 
    x-ref="popperRef"
    x-on:click="isShowPopper = !isShowPopper" 
    class="flex items-center justify-center p-1 rounded hover:bg-slate-600"
>
    {{ $slot }}
</button>
