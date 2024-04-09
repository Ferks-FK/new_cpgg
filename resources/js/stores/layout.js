export default {
    init() {
        const storedState = localStorage.getItem("sidebarState");

        if (storedState === null) {
            this.sidebar.open = false;
        } else {
            this.sidebar.open = storedState === 'true' && Alpine.store("breakpoints").mdAndUp;
        }
    },
    sidebar: {
        open: false,

        toggle() {
            this.open = !this.open;
            localStorage.setItem("sidebarState", this.open);
        },
    }
};
