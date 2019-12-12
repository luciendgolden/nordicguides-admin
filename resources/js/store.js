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
        fetchMembersNotIn({ commit }, id) {
            return new Promise((resolve, reject) => {
                Repository.get(`/members/notin/${id}`)
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
        logout({commit}){
            commit('SET_USER', {});
            commit('SET_LOGIN', false);
        },
        editLanguage({commit}, editedItem){
            Repository.post('/languages', editedItem)
                .then(() => commit('ADD_LANGUAGE', editedItem))
                .catch(err => console.log(err));
        },
        deleteLanguage({commit}, language){
            Repository.delete(`/languages/${language.language}`)
                .then(() => commit('DELETE_LANGUAGE', language))
                .catch(err => console.log(err));
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
        ADD_LANGUAGE(state, item){
            state.languages.unshift(item)
        },
        DELETE_LANGUAGE(state, language){
            const index = state.languages.indexOf(language);
            state.languages.splice(index, 1);
        },
    },
    getters: {},
});

export default store;
