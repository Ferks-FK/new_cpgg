import axios from '../../services/axios'

export default () => ({
    users: [],
    servers: [],

    form: {
        data: {
            id: '',
            name: '',
            user_id: '',
        },
        errors: {
            name: null,
            user_id: null,
        },
        loading: false
    },

    confirm: {
        id: null,
        name: null,
        loading: false
    },

    handleConfirm(confirm) {
        this.confirm.id = this.server.id
        this.confirm.name = this.server.name

        this.$dispatch("confirm", confirm);
    },

    async handleUpdate() {
        this.form.loading = true

        try {
            const { data } = await axios.patch(`/admin/servers/update/${this.form.data.id}`, this.form.data)
            
            this.$dispatch('toast', {
                message: data.message,
                type: 'success',
                pending: true
            });

            window.location.href = data.redirect
        } catch (error) {
            const errors = error.response.data.errors;
            this.form.errors = {};
            console.error(error)

            for (const field in errors) {
                this.form.errors[field] = errors[field][0];
            }
        } finally {
            this.form.loading = false
        }
    },

    async handleSuspend() {
        this.confirm.loading = true

        try {
            const { data } = await axios.post('/admin/servers/suspend', { id: this.confirm.id })

            this.servers = this.servers.map(server => {
                if (server.id === this.confirm.id) {
                    server.suspended = data.server.suspended,
                    server.suspended_at = data.server.suspended_at
                }

                return server
            })

            this.$dispatch('toast', {
                message: data.message,
                type: 'success'
            });
        } catch (error) {
            this.$dispatch('toast', {
                message: error.response.data.message,
                type: 'error'
            });

            console.error(error)
        } finally {
            this.confirm.loading = false

            this.$dispatch("confirm");
        }
    },

    async handleUnsuspend() {
        this.confirm.loading = true

        try {
            const { data } = await axios.post('/admin/servers/unsuspend', { id: this.confirm.id })

            this.servers = this.servers.map(server => {
                if (server.id === this.confirm.id) {
                    server.suspended = data.server.suspended,
                    server.suspended_at = data.server.suspended_at
                }

                return server
            })

            this.$dispatch('toast', {
                message: data.message,
                type: 'success'
            });
        } catch (error) {
            this.$dispatch('toast', {
                message: error.response.data.message,
                type: 'error'
            });

            console.error(error)
        } finally {
            this.confirm.loading = false

            this.$dispatch("confirm");
        }
    },

    async handleDelete() {
        this.confirm.loading = true

        try {
            const { data } = await axios.delete('/admin/servers/' + this.confirm.id)

            this.servers = this.servers.filter(server => server.id !== this.confirm.id)

            this.$dispatch('toast', {
                message: data.message,
                type: 'success'
            });
        } catch (error) {
            this.$dispatch('toast', {
                message: error.response.data.message,
                type: 'error'
            });

            console.error(error)
        } finally {
            this.confirm.loading = false

            this.$dispatch("confirm");
        }
    },

    setServersData(servers) {
        this.servers = servers
    },

    setServerData(server) {
        this.form.data = Object.assign({}, this.form.data, server)
    },

    setUsersData(users) {
        this.users = users
    }
})