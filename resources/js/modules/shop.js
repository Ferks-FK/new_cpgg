import axios from '../services/axios'

export default () => ({
    categoryData: {},
    categories: [],
    loading: false,
    loadingProduct: {},

    async updateCart(product_id, quantity = 1) {
        this.loadingProduct[product_id] = true

        try {
            const { data } = await axios.patch('/cart', {
                product_id,
                quantity,
            })

            this.$dispatch('toast', {
                message: data.message,
                type: 'success',
            })
        } catch (error) {
            console.error(error)
        } finally {
            this.loadingProduct[product_id] = false
        }
    },

    setFlashMessage(flash) {
        let keys = Object.keys(flash)[0]

        if (keys === undefined) {
            return
        }

        let message = flash[keys]

        let type = keys === 'success' ? 'success' : 'error'

        this.$nextTick(() => {
            this.$dispatch('toast', {
                message: message,
                type: type
            })
        })
    },

    setCategoryData(category) {
        this.categoryData = category
    },

    setCategoriesData(categories) {
        this.categories = categories
    }
})
