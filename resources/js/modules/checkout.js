import axios from '../services/axios'

export default () => ({
    gateways: [],

    async handleCheckout(gateway) {
        try {
            const { data } = await axios.post(`/checkout/${gateway}`)


        } catch (error) {
            console.error(error)
        }
    },

    setGatewaysData(gateways) {
        this.gateways = gateways
    }
})
