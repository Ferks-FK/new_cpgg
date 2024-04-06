import axios from "axios";

let csrf = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
axios.defaults.headers.common["X-CSRF-TOKEN"] = csrf;

axios.interceptors.response.use(
    function (response) {
        return response;
    },
    function (error) {
        if (error.response.status === 419) {
            window.location.reload();
        }

        return Promise.reject(error);
    }
);

window.axios = axios;

export default axios;
