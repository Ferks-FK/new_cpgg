import axios from '../../services/axios';

export default () => ({
    users: [],

    form: {
        data: {
            first_name: '',
            last_name: '',
            username: '',
            credits: 250,
            server_limit: 1,
            email: '',
            password: '',
            password_confirmation: '',
        },
        errors: {
            first_name: null,
            last_name: null,
            username: null,
            credits: null,
            server_limit: null,
            email: null,
            password: null,
            password_confirmation: null,
        },
        loading: false
    },

    confirm: {
        id: null,
        name: null,
        loading: false
    },

    handleConfirm() {
        this.confirm.id = this.user.id
        this.confirm.name = this.user.first_name + ' ' + this.user.last_name

        this.$dispatch("confirm");
    },

    async handleCreate() {
        this.form.loading = true

        try {
            const { data } = await axios.post('/admin/users/store', this.form.data)

            this.$dispatch('toast', {
                message: data.message,
                type: 'success'
            });

            this.form.errors = {};
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

    async handleUpdate() {
        this.form.loading = true

        try {
            const { data } = await axios.patch(`/admin/users/update/${this.form.data.id}`, this.form.data)

            this.$dispatch('toast', {
                message: data.message,
                type: 'success'
            });

            this.form.errors = {};
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

    async handleDelete() {
        this.confirm.loading = true

        try {
            const { data } = await axios.delete('/admin/users/' + this.confirm.id)

            this.users = this.users.filter(user => user.id !== this.confirm.id)

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

    setUsersData(users) {
        this.users = users;
    },

    setUserData(user) {
        this.form.data = user;
    },
})