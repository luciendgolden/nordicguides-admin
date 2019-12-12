import Vue from 'vue';
import VueRouter from 'vue-router'

import UserProfile from "./views/UserProfile.vue";
import Login from "./views/Login.vue";
import Members from "./views/Members";
import Languages from "./views/Languages";
import Fees from "./views/Fees";
import Logout from "./views/Logout";
import Register from "./views/Register";

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/user-profile',
        name: 'User Profile',
        component: UserProfile
    },
    {
        path: '/members',
        name: 'Members',
        component: Members
    },
    {
        path: '/languages',
        name: 'Languages',
        component: Languages
    },
    {
        path: '/fees',
        name: 'Fees',
        component: Fees
    },
    {
        path: '/logout',
        name: 'Logout',
        component: Logout
    },
]

export default new VueRouter({
    mode: 'history',
    base: '/admin',
    routes,
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
})
