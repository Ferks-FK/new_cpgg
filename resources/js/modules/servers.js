import axios from '../services/axios';

export default () => ({
    products: [],
    nests: [],
    eggs: [],
    locations: [],

    form: {
        data: {
            name: '',
            nest_id: '',
            egg_id: '',
            node_id: '',
            location_id: '',
        },
        errors: {
            name: null,
            nest_id: null,
            egg_id: null,
            node_id: null,
            location_id: null,
        },
        loading: false
    },

    async getEggsByNestId() {
        if (!this.form.data.nest_id) {
            if (this.eggs.length) {
                this.eggs = []
            }

            this.$refs.egg.disabled = true;

            return
        }

        try {
            const { data } = await axios.get(`/servers/nests/${this.form.data.nest_id}/eggs`)
    
            if (this.eggs.length) {
                this.eggs = []
            }
    
            data.forEach((egg) => {
                this.eggs.push({
                    id: egg.attributes.id,
                    name: egg.attributes.name
                })
            })
        } catch (error) {
            console.error(error)
        }
    },

    async handleProduct(product_id) {
        console.log(product_id)
    },

    CheckResourcesByNodeId() {
        if (!this.form.data.node_id) {
            return
        }

        const location = this.locations.find(location => location.node_data.id == this.form.data.node_id)

        this.products = this.products.map((product) => {
            const free_memory = (location.node_data.resources.memory * (location.node_data.rosources_overallocated.memory + 100) / 100) - location.node_data.allocated_resources.memory;
            const free_disk = (location.node_data.resources.disk * (location.node_data.rosources_overallocated.disk + 100) / 100) - location.node_data.allocated_resources.disk;

            product.is_installable = product.memory < free_memory && product.disk < free_disk;

            return product;
        })
    },

    setNestsData(nests) {
        nests.forEach((nest) => {
            this.nests.push({
                id: nest.attributes.id,
                name: nest.attributes.name
            })
        })
    },

    setProductsData(products) {
        this.products = products
    },

    setLocationsData(locations) {
        locations.forEach((location) => {
            const node = location.attributes.relationships.nodes.data[0].attributes

            this.locations.push({
                id: location.attributes.id,
                name: location.attributes.long ? `${location.attributes.short} - ${location.attributes.long}` : location.attributes.short,
                node_data: {
                    id: node.id,
                    allocated_resources: {
                        disk: node.allocated_resources.disk,
                        memory: node.allocated_resources.memory,
                    },
                    resources: {
                        disk: node.disk,
                        memory: node.memory,                        
                    },
                    rosources_overallocated: {
                        disk: node.disk_overallocate,
                        memory: node.memory_overallocate,
                    }
                }
            })
        })
    }
})