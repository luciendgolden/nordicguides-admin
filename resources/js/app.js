// require('./bootstrap');

window.Vue = require('vue');

import vuetify from './plugins/vuetify.js'
import App from './App.vue'

const app = new Vue({
    vuetify,
    render: h => h(App)
}).$mount('#app');;
