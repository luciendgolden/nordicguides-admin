import Vue from 'vue';
import VueRouter from 'vue-router'

import UserProfile from "./views/UserProfile.vue";
import Login from "./views/Login.vue";

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Login',
        component: Login
    },
    {
        path: '/user-profile',
        name: 'User Profile',
        component: UserProfile
    }
]

export default new VueRouter({
    mode: 'history',
    base: '/admin',
    routes,
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
})
