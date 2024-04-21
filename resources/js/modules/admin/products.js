import axios from '../../services/axios'

export default () => ({
    products: [],
    nodes: [],
    eggs: [],

    form: {
        data: {
            name: '',
            description: '',
            price: '',
            memory: '',
            disk: 1024,
            cpu: '',
            swap: 0,
            io: 500,
            databases: 1,
            backups: 1,
            allocations: 1,
            minimum_credits: 50,
            active: true,
            nodes: [],
            eggs: []
        },
        errors: {
            name: null,
            description: null,
            price: null,
            memory: null,
            disk: null,
            cpu: null,
            swap: null,
            io: null,
            databases: null,
            backups: null,
            allocations: null,
            minimum_credits: null,
        },
        loading: false
    },

    confirm: {
        id: null,
        name: null,
        loading: false
    },

    handleConfirm(confirm) {
        this.confirm.id = this.form.data.id
        this.confirm.name = this.form.data.name

        this.$dispatch("confirm", confirm);
    },

    async handleUpdate() {
        this.form.loading = true

        try {
            const { data } = await axios.patch(`/admin/products/update/${this.form.data.id}`, this.form.data)
            
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

    async handleCreate() {
        this.form.loading = true

        try {
            const { data } = await axios.post('/admin/products/store', this.form.data)

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
            const { data } = await axios.delete(`/admin/products/${this.confirm.id}`)

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

    setProductsData(products) {
        this.products = products
    },

    setProductData(product) {
        this.form.data = Object.assign({}, this.form.data, product)
    },

    setNodesData(nodes) {
        this.nodes = nodes
    },

    setEggsData(eggs) {
        this.eggs = eggs
    }
})