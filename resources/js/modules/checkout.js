import axios from '../services/axios'

export default () => ({
    gateways: [],

    handleCheckout(event, gatewayType) {
        const href = event.currentTarget.href;

        const form = document.getElementById('submitForm');
        form.action = href + gatewayType;

        form.submit();
    },

    setGatewaysData(gateways) {
        this.gateways = gateways
    }
})
