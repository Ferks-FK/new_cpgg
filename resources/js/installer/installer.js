import Alpine from 'alpinejs';
import axios from '../services/axios'

Alpine.data('installer', () => ({
    step: null,
    steps: [
        'requirements',
        'database',
        'enviroment',
        'account'
    ],
    requirements: null,

    form: {
        enviroment: {
            data: {
                app_name: '',
                app_url: '',
                panel: '',
                panel_url: '',
                panel_api_key: '',
            },
            errors: {
                app_name: null,
                app_url: null,
                panel: null,
                panel_url: null,
                panel_api_key: null,
            },
            loading: false
        },
        database: {
            data: {
                database_name: '',
                database_username: '',
                database_password: '',
                database_host: '',
                database_port: '',
            },
            errors: {
                database_name: null,
                database_username: null,
                database_password: null,
                database_host: null,
                database_port: null,
            },
            loading: false
        },
        account: {
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
                password_confirmation: null,
            },
            loading: false
        }
    },

    init() {
        this.step = window.location.pathname.split('/').pop();
    },

    isStepCompleted(step) {
        const currentIndex = this.steps.indexOf(this.step);
        const stepIndex = this.steps.indexOf(step);

        return stepIndex < currentIndex;
    },

    isStepActive(step) {
        return this.step === step;
    },

    async handleEnviroment() {
        this.form.enviroment.loading = true;

        try {
            const { data } = await axios.post('/install/enviroment', this.form.enviroment.data);

            window.location.href = data.redirect;
        } catch (error) {
            const errors = error.response.data.errors;
            this.form.enviroment.errors = {};
            console.error(error)

            for (const field in errors) {
                this.form.enviroment.errors[field] = errors[field][0];
            }
        } finally {
            this.form.enviroment.loading = false;
        }
    },

    async handleDatabase() {
        this.form.database.loading = true;

        try {
            const { data } = await axios.post('/install/database', this.form.database.data);

            window.location.href = data.redirect;
        } catch (error) {
            const errors = error.response.data.errors;
            this.form.database.errors = {};
            console.error(error)

            if (error.response.status === 400) {
                this.$dispatch('toast', {
                    type: 'error',
                    message: error.response.data.message
                })
            }

            for (const field in errors) {
                this.form.database.errors[field] = errors[field][0];
            }
        } finally {
            this.form.database.loading = false;
        }
    },

    async handleAccount() {
        this.form.account.loading = true;

        try {
            const { data } = await axios.post('/install/account', this.form.account.data);

            this.$dispatch('toast', {
                type: 'success',
                message: data.message,
                pending: true
            })

            window.location.href = data.redirect;
        } catch (error) {
            const errors = error.response.data.errors;
            this.form.account.errors = {};
            console.error(error)

            if (error.response.status === 400) {
                this.$dispatch('toast', {
                    type: 'error',
                    message: error.response.data.message
                })
            }

            for (const field in errors) {
                this.form.account.errors[field] = errors[field][0];
            }
        } finally {
            this.form.account.loading = false;
        }
    },

    setRequirementsData(requirements) {
        this.requirements = requirements;
    },

    setEnviromentData(enviroment) {
        this.form.enviroment.data = Object.assign({}, this.form.enviroment.data, enviroment)
    },

    setDatabaseData(database) {
        this.form.database.data = Object.assign({}, this.form.database.data, database)
    },
}))

Alpine.start();
