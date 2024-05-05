import axios from '../../services/axios'

export default () => ({
    products: [],

    form: {
        data: {
            name: '',
            description: '',
            type: 'credits',
            price: '',
            quantity: '',
            category_id: '',
            active: true,
        },
        errors: {
            name: null,
            description: null,
            type: null,
            price: null,
            quantity: null,
            category_id: null,
            active: null
        },
        loading: false
    },

    confirm: {
        id: null,
        name: null,
        loading: false
    },

    handleConfirm(confirm) {
        this.confirm.id = this.product.id
        this.confirm.name = this.product.name

        this.$dispatch("confirm", confirm);
    },

    async handleCreate() {
        this.form.loading = true

        try {
            const { data } = await axios.post('/admin/store/store/', this.form.data)

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

    async handleUpdate() {
        this.form.loading = true

        try {
            const { data } = await axios.patch(`/admin/store/update/${this.form.data.id}`, this.form.data)

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

    async handleDelete() {
        this.confirm.loading = true

        try {
            const { data } = await axios.delete(`/admin/store/delete/${this.confirm.id}`)

            this.products = this.products.filter(product => product.id !== this.confirm.id)

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


    setStoreProductsData(products) {
        this.products = products
    },

    setStoreProductData(product) {
        this.form.data = Object.assign({}, this.form.data, product)
    }
})