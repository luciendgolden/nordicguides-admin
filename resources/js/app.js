// require('./bootstrap');

window.Vue = require('vue');

import vuetify from './plugins/vuetify.js'
import router from "./router";
import store from "./store";
import App from './App.vue'

const app = new Vue({
    vuetify,
    router,
    store,
    render: h => h(App)
}).$mount('#app');;
