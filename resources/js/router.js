import Vue from 'vue';
import VueRouter from 'vue-router'

import UserProfile from "./views/UserProfile.vue";

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'User Profile',
        component: UserProfile
    }
]

export default new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
})
