import Vue from 'vue';
import Vuex from 'vuex';

import Repository from "./service/repository";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
            user: {
                "memberID": 1,
                "birthdate": null,
                "firstname": "John",
                "lastname": "Doe",
                "street": "Hallituskatu 1",
                "city": "Tornio",
                "zip": "95400",
                "phone": null,
                "email": "jdoe@lapinamk.fi",
                "role": "member",
                "driverslicense": null,
                "profileimage": "https://res.cloudinary.com/dj4qfshsx/image/upload/v1576023571/nordicguides/guide/marc.aba54d65_nlmplz.jpg",
                "created_at": null,
                "updated_at": null
            },
    },
    mutations: {
        GET_USER(state, user){
            state.user = user
        }
    },
    actions: {
        getUser({commit}, user){
            commit('GET_USER', user)
        },
    },
    getters: {

    },
});

export default store;
