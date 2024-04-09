import axios from '../services/axios';

export default () => ({
    form: {
        data: {
            first_name: '',
            last_name: '',
            email: '',
            password: '',
            password_confirmation: '',
        },
        errors: {
            first_name: null,
            last_name: null,
            email: null,
            password: null,
            password_confirmation: null
        },
        loading: false
    },

    async handleRegister() {
        this.form.loading = true;

        try {
            const { data } = await axios.post('/register', this.form.data);

            this.$dispatch('toast', {
                message: data.message,
                type: 'success',
                pending: true
            })

            window.location.href = data.redirect;
        } catch (error) {
            const errors = error.response.data.errors;
            this.form.errors = {};

            for (const field in errors) {
                this.form.errors[field] = errors[field][0];
            }
        } finally {
            this.form.loading = false;
        }
    }
})