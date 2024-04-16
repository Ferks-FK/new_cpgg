import axios from '../../services/axios';

export default () => ({
    users: [],

    form: {
        data: {
            email: '',
            username: '',
            password: '',
            password_confirmation: '',
            root_admin: false,
            language: 'en',
            permissions: []
        },
        errors: {
            email: null,
            username: null,
            password: null,
            password_confirmation: null,
            root_admin: null,
            language: null,
            permissions: null
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
        console.log(users)
        this.users = users;
    }
})