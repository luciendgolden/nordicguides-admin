<template>
    <div v-if="user">
        <v-container
            fill-height
            fluid
            grid-list-xl>
            <v-layout
                justify-center
                wrap
            >
                <v-flex xs12 md8>
                    <v-card>
                        <v-card-text>
                            <v-form>
                                <v-container>
                                    <v-layout row wrap>
                                        <v-flex xs12 sm6 v-for="(value, key) in user" :key="key">
                                            <v-text-field  @change="getUser" :value="value" :label="key"></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 v-if="groupNames.length > 0 && languages.length > 0">
                                            <v-flex xs12 sm6>
                                                <v-combobox v-model="groupNames" label="Membergroups" chips multiple
                                                            readonly></v-combobox>
                                            </v-flex>
                                            <v-flex xs12 sm6>
                                                <v-combobox v-model="languages" label="Languages" chips multiple
                                                            readonly></v-combobox>
                                            </v-flex>
                                        </v-flex>
                                        <v-flex
                                            xs12
                                            text-xs-right
                                        >
                                            <v-btn
                                                class="mx-0 font-weight-light"
                                                color="success"
                                            >
                                                Update Profile
                                            </v-btn>
                                        </v-flex>
                                    </v-layout>
                                </v-container>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex
                    xs12
                    md4
                >
                    <v-card>
                        <v-flex xs12>
                            <v-avatar
                                slot="offset"
                                class="mx-auto d-block"
                                size="130">
                                <img
                                    :src="user.profileimage"
                                    alt="John"
                                >
                            </v-avatar>
                        </v-flex>
                        <v-card-text class="text-xs-center">
                            <h6 class="category text-gray font-weight-thin text-uppercase mb-3">{{ user.role }}</h6>
                            <h4 class="card-title font-weight-light">{{ user.firstname }} {{ user.lastname }}</h4>
                            <p class="card-description font-weight-light">Don't be scared of the truth because we need
                                to restart the human foundation in truth And I love you like Kanye loves Kanye I love
                                Rick Owens’ bed design but the back is...</p>
                            <v-btn
                                color="success"
                                rounded
                                class="font-weight-light"
                            >Follow
                            </v-btn>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    import Repository from "../service/repository";

    export default {
        name: "UserProfile",
        data() {
            return {
                image: 'https://res.cloudinary.com/dj4qfshsx/image/upload/v1576023571/nordicguides/guide/marc.aba54d65_nlmplz.jpg',
                groups: [],
                memberlanguages: [],
                myUser: {}
            }
        },
        methods:{
            getUser(e){
                this.$store.dispatch('getUser', e.target.value)
            }
        },
        computed: {
            user() {
                return this.$store.state.user;
            },
            languages() {
                return this.memberlanguages.map(language => {
                    return language['language'] + ' ' + language['level'];
                });
            },
            groupNames() {
                return this.groups.map(group => group['groupname']);
            },
        },
        created() {
            let id = this.user.memberID;
            Promise.all([
                new Promise(resolve => {
                    Repository.get(`/group/${id}`)
                        .then(res => res.data)
                        .then(data => {
                            this.groups = data;
                            resolve();
                        })
                        .catch(err => {
                            console.log(err);
                        });
                }),
                new Promise(resolve => {
                    Repository.get(`/memberlanguages/${id}`)
                        .then(res => res.data)
                        .then(data => {
                            this.memberlanguages = data;
                            resolve();
                        })
                        .catch(err => {
                            console.log(err);
                        });
                })
            ]);
        }
    }
</script>
