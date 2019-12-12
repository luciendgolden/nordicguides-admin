import Vue from 'vue';
import Vuex from 'vuex';

import Repository from "./service/repository";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        loggedIn: false,
        user: {},
        members: [],
        languages: [],
        fees: [],
    },
    actions: {
        loginUser({commit}, data){
            new Promise((resolve, reject) => {
                Repository.post('/login',data).then(res => res.data)
                    .then(data => resolve(commit('SET_USER', data)))
                    .catch(err => reject(err));
            })
        },
        updateUser({commit}, editedUser) {
            new Promise((resolve, reject) => {
                const id = editedUser.memberID;

                const baseDomain = 'http://nordicguides-admin.test';
                const baseURL = `${baseDomain}/api/members/${id}`;

                const url = new URL(baseURL);
                const params = editedUser;
                Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))

                fetch(url, {
                    method: 'PUT'})
                    .then(res => res.json())
                    .then(data => {
                        //commit('SET_LOGIN', true);
                        commit('SET_USER', data);
                        resolve()
                    })
                    .catch(err => reject(err));
            });
        },
        fetchMembers({ commit }) {
            return new Promise((resolve, reject) => {
                Repository.get('/members')
                    .then(res => res.data)
                    .then(data => {
                        commit('SET_MEMBERS', data);
                        resolve();
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        fetchLanguages({ commit }) {
            return new Promise((resolve, reject) => {
                Repository.get('/languages')
                    .then(res => res.data)
                    .then(data => {
                        commit('SET_LANGUAGES', data);
                        resolve();
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        fetchFees({ commit }) {
            return new Promise((resolve, reject) => {
                Repository.get('/fees')
                    .then(res => res.data)
                    .then(data => {
                        commit('SET_FEES', data);
                        resolve();
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        logout({commit}){
            commit('SET_USER', {});
            commit('SET_LOGIN', false);
        }
    },
    mutations: {
        SET_USER(state, user) {
            state.loggedIn = true;
            state.user = user
        },
        SET_LOGIN(state, bool){
            state.loggedIn = bool;
        },
        SET_MEMBERS(state, members) {
            state.members = members;
        },
        SET_LANGUAGES(state, languages) {
            state.languages = languages;
        },
        SET_FEES(state, fees) {
            state.fees = fees;
        },
    },
    getters: {},
});

export default store;
