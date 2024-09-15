import axios from '../../services/axios';

export default () => ({
    form: {
        data: {
            site_name: '',
            site_url: '',
            credits_display: '',
            pterodactyl_api_url: '',
            pterodactyl_api_key: '',
        },
        errors: {
            site_name: null,
            site_url: null,
            credits_display: null,
            pterodactyl_api_url: null,
            pterodactyl_api_key: null,
        },
        loading: false
    },

    async updateSettings(setting) {
        this.form.loading = true

        try {
            const { data } = await axios.patch(`/admin/${setting}/update`, this.form.data)

            this.$dispatch('toast', {
                message: data.message,
                type: 'success'
            });
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

    setSettingsData(settings) {
        this.form.data = Object.assign({}, this.form.data, settings)
    }
})
