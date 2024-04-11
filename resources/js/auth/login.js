import axios from '../services/axios';

export default () => ({
    form: {
        data: {
            email: '',
            password: '',
            remember: false
        },
        errors: {
            email: null,
            password: null
        },
        loading: false
    },

    async handleLogin() {
        this.form.loading = true;

        try {
           const { data } = await axios.post('/login', this.form.data);

           window.location.href = data.redirect;
        } catch (error) {
            const errors = error.response.data.errors;
            this.form.errors = {};
            console.error(error)

            for (const field in errors) {
                this.form.errors[field] = errors[field][0];
            }
        } finally {
            this.form.loading = false;
        }
    }
})