const { h } = require('vue');

window.Vue = require('vue');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import App from "./views/App.vue";

//importo il router
import router from './router';

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router: router
});
