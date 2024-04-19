import axios from '../services/axios';

export default () => ({
    products: [],
    eggs: [],
    nodes: [],

    form: {
        data: {
            name: '',
            egg_id: '',
            node_id: '',
        },
        errors: {
            name: null,
            egg_id: null,
            node_id: null,
        },
        loading: false
    },

    async handleProduct(product_id) {
        this.form.data.product_id = product_id

        try {
            const { data } = await axios.post('/servers/store', this.form.data)

            this.$dispatch('toast', {
                message: data.message,
                type: 'success',
                pending: true
            })

            window.location.href = data.redirect;
        } catch (error) {
            if (error.response.status === 400) {
                this.$dispatch('toast', {
                    message: error.response.data.message,
                    type: 'error',
                    pending: true
                })

                window.location.href = error.response.data.redirect;

                return
            }

            const errors = error.response.data.errors;
            this.form.errors = {};
            console.error(error)

            for (const field in errors) {
                this.form.errors[field] = errors[field][0];
            }
        }
    },

    CheckResourcesByNodeId() {
        if (!this.form.data.node_id) {
            return
        }

        const node = this.nodes.find(node => node.id == this.form.data.node_id)

        this.products = this.products.map((product) => {
            const free_memory = (node.memory * (node.memory_overallocate + 100) / 100) - node.allocated_resources.memory;
            const free_disk = (node.disk * (node.disk_overallocate + 100) / 100) - node.allocated_resources.disk;

            product.is_installable = product.memory < free_memory && product.disk < free_disk;

            return product;
        })
    },

    setEggsData(eggs) {
       this.eggs = eggs.map((egg) => ({ id: egg.attributes.id, name: egg.attributes.name}))
    },

    setProductsData(products) {
        this.products = products
    },

    setNodesData(nodes) {
        this.nodes = nodes.map((node) => {
            return {
                id: node.attributes.id,
                name: node.attributes.name,
                memory: node.attributes.memory,
                disk: node.attributes.disk,
                memory_overallocate: node.attributes.memory_overallocate,
                disk_overallocate: node.attributes.disk_overallocate,
                allocated_resources: {
                    memory: node.attributes.allocated_resources.memory,
                    disk: node.attributes.allocated_resources.disk,
                },
            }
        })
    }
})