import axios from '../services/axios'

export default () => ({
    cart: null,
    total: 0,
    loading: false,

    async updateItem(product_id, quantity) {
        this.loading = true

        try {
            const { data } = await axios.patch(`/cart`, {
                product_id,
                quantity,
                increment: false
            })

            console.log(data)

            this.calculateTotal()

            this.$dispatch('toast', {
                message: data.message,
                type: 'success',
            })
        } catch (error) {
            console.error(error)
        } finally {
            this.loading = false
        }
    },

    async removeItem(item_id) {
        this.loading = true

        try {
            const { data } = await axios.delete(`/cart/item/${item_id}`)

            console.log(data)

            if (data.cart) {
                this.cart.items = this.cart.items.filter(item => item.id !== item_id)

                this.calculateTotal()
            } else {
                this.cart = null
                this.total = 0
            }

            this.$dispatch('toast', {
                message: data.message,
                type: 'success',
            })
        } catch (error) {
            console.error(error)
        } finally {
            this.loading = false
        }
    },

    async clearCart() {
        this.loading = true

        try {
            const { data } = await axios.delete(`/cart/${this.cart.id}`)

            this.cart = null
            this.total = 0

            this.$dispatch('toast', {
                message: data.message,
                type: 'success',
            })
        } catch (error) {
            console.error(error)
        } finally {
            this.loading = false
        }
    },

    setCartData(cart) {
        this.cart = cart

        if (this.cart) {
            this.calculateTotal(this.total)
        }
    },

    calculateTotal(total = 0) {
        this.total = this.cart.items.reduce((total, item) => {
            return total + (parseInt(item.product.price) * item.quantity)
        }, total)
    }
})
