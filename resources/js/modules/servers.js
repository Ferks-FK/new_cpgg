import axios from '../services/axios';

export default () => ({
    products: [],
    original_products: [],
    eggs: [],
    locations: [],
    has_node_to_install: false,

    form: {
        data: {
            name: '',
            egg_id: '',
            location_id: '',
            egg_variables: [],
        },
        errors: {
            name: null,
            egg_id: null,
            location_id: null,
            egg_variables: []
        },
        loading: false
    },

    confirm: {
        data: {},
        loading: false
    },

    handleConfirm(confirm) {
        this.$dispatch('modal', confirm)
    },

    async handleProduct() {
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
            console.error(error)

            for (const field in errors) {
                this.form.errors[field] = errors[field][0];

				if (field.startsWith('egg_variables.')) {
					const [_, index, subField] = field.split('.');

					if (this.form.errors.egg_variables[index] === undefined) {
						this.form.errors.egg_variables[index] = {};
					}

					this.form.errors.egg_variables[index][subField] = errors[field];
				}
            }
        }
    },

    CheckResourcesByLocation() {
        if (!this.form.data.location_id) {
            return
        }

        const location = this.locations.find(location => location.attributes.id == this.form.data.location_id)

        location.attributes.relationships.nodes.data.map((node) => {
            this.original_products.forEach((product) => {
                const free_memory = (node.attributes.memory * (node.attributes.memory_overallocate + 100) / 100) - node.attributes.allocated_resources.memory;
                const free_disk = (node.attributes.disk * (node.attributes.disk_overallocate + 100) / 100) - node.attributes.allocated_resources.disk;

                if (product.memory < free_memory && product.disk < free_disk) {
                    this.has_node_to_install = true;
                    product.is_installable = true;

                    return product
                }
            })
        })
    },

    setRequiredVariables(egg_id) {
        if (!egg_id) {
            return
        }

        this.form.data.egg_variables = []

        const egg = this.eggs.find(egg => egg.value == egg_id)

        egg.variables.forEach((variable) => {
            if (variable.attributes.rules.includes('required') && !variable.attributes.default_value) {
                this.form.data.egg_variables.push({
                    id: variable.attributes.env_variable,
                    label: variable.attributes.name,
                    value: '',
                    type: 'string',
                    rules: variable.attributes.rules
                })
            }
        })
    },

    setEggsData(eggs) {
        this.eggs = eggs
    },

    setProductsData(products) {
        this.original_products = products
    },

    setLocationsData(locations) {
        this.locations = locations
    },

    getProductByEggId() {
        this.products = this.original_products.filter(product => {
            return product.eggs.some((egg) => egg.value == parseInt(this.form.data.egg_id));
        });
    }
})
