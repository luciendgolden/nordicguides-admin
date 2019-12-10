// src/plugins/vuetify.js

import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify)

const opts = {
    theme: {
        primary: '#ff4f2b',
        secondary: '#429798',
    },
    iconfont: 'mdi',
}

export default new Vuetify(opts)
