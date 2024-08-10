import axios from "../../services/axios";

export default () => ({
    form: {
        data: {

        },
        errors: {

        },
        loading: false
    },

    async handleUpdate() {
        this.form.loading = true;

        try {
            const { data } = await axios.patch(`/admin/gateways/update/${this.$refs.gateway.value}`, this.form.data);

            this.$dispatch('toast', {
                message: data.message,
                type: 'success'
            });

        } catch (error) {
            const errors = error.response.data.errors;

            for (const field in errors) {
                this.form.errors[field] = errors[field][0];
            }

            this.$dispatch('validation-errors', this.form.errors);
        }

        this.form.loading = false;
    },

    setGatewayData(gateway) {
        this.form.data = gateway.data;
        this.form.data.active = gateway.active ? '1' : '0';
    }
})
