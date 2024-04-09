<div
	x-data="{
        toasts: [],
		visible: [],

        init() {
            const pendingToast = localStorage.getItem('pendingToast');

            if (pendingToast) {
                const { id, message, type } = JSON.parse(pendingToast);

                this.toasts.push({ id, message, type, pending: true });
                this.fire(id)

                localStorage.removeItem('pendingToast');
            }
        },

		add(toast) {
            if (toast.pending) {
                const id = Date.now();

                this.saveToast(id, toast.message, toast.type);

                return
            }

            if (this.toasts.length >= 3) {
                return
            }

			toast.id = Date.now()
			this.toasts.push(toast)
			this.fire(toast.id)
		},

        saveToast(id, message, type) {
            const toast = {id, message, type };
    
            localStorage.setItem('pendingToast', JSON.stringify(toast));
        },
        
		fire(id) {
			this.visible.push(this.toasts.find(toast => toast.id == id))
			const timeShown = 2000 * this.visible.length

			setTimeout(() => {
				this.remove(id)
			}, timeShown)
		},

		remove(id) {
			const toast = this.visible.find(toast => toast.id == id)
			const index = this.visible.indexOf(toast)
			this.visible.splice(index, 1)

            setTimeout(() => {
				this.toasts = this.toasts.filter(toast => toast.id !== id)
			}, 2000)
		},
    }"
	class="fixed bottom-0 right-0 z-[100] flex gap-2 max-h-screen w-full flex-col-reverse p-4 sm:bottom-0 sm:right-0 sm:top-auto sm:flex-col md:max-w-[380px]"
    x-on:toast.window="add($event.detail)"
	style="pointer-events:none">
	<template x-for="toast of toasts" :key="toast.id">
		<div
			x-show="visible.includes(toast)"
			x-transition:enter="transition ease-in duration-200"
			x-transition:enter-start="transform opacity-0 translate-y-2"
			x-transition:enter-end="transform opacity-100"
			x-transition:leave="transition ease-out duration-500"
			x-transition:leave-start="transform translate-x-0 opacity-100"
			x-transition:leave-end="transform translate-x-full opacity-0"
            x-on:click="remove(toast.id)"
			class="relative flex items-center justify-between w-full p-4 pr-8 overflow-hidden text-white transition-all rounded-md shadow-lg pointer-events-auto group"
			x-bind:class="{
				'bg-green-500': toast.type === 'success',
				'bg-blue-500': toast.type === 'info',
				'bg-orange-500': toast.type === 'warning',
				'bg-red-500': toast.type === 'error',
			 }"
			style="pointer-events:all"
			x-text="toast.message">
		</div>
	</template>
</div>