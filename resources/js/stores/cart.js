import axios from '../services/axios'

export default {
    cart: [],
    total: 0,
    loading: false,

    async init() {
        this.loading = true

        try {
            const { data } = await axios.get('/cart')

            this.cart = data.cart
            this.total = data.total
        } catch (error) {
            console.error(error)
        }

        this.loading = false
    },

    async update(product_id, quantity = 1) {
        this.loading = true

        try {
            const { data } = await axios.patch('/cart', {
                product_id,
                quantity,
            })

            console.log(this.$el)

            // TODO: Alpine context not working on store.
            this.$dispatch('toast', {
                message: data.message,
                type: 'success',
            })

            console.log(data)

            // this.cart = data.cart
            // this.total = data.total
        } catch (error) {
            console.error(error)
        } finally {
            this.loading = false
        }
    },

    async remove(product) {
        this.loading = true

        try {
            const { data } = await axios.delete('/cart', {
                data: {
                    product_id: product.id,
                },
            })

            this.cart = data.cart
            this.total = data.total
        } catch (error) {
            console.error(error)
        }

        this.loading = false
    },
}