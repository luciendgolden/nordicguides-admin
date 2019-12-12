<template>
    <v-container>
        <v-layout align-center justify-center>
            <v-data-table
                :headers="headers"
                :items="members"
                :items-per-page="10"
                class="elevation-1"
            ></v-data-table>
        </v-layout>
    </v-container>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name: "Members.vue",
        data(){
            return {
                headers: [
                    { text: 'ID', value: 'memberID' },
                    { text: 'Firstname', value: 'firstname' },
                    { text: 'Lastname', value: 'lastname' },
                    { text: 'Email', value: 'email' },
                    { text: 'Birthdate', value: 'birthdate' },
                    { text: 'Street', value: 'street' },
                    { text: 'City', value: 'city' },
                    { text: 'ZIP', value: 'zip' },
                    { text: 'Role', value: 'role' },
                    { text: 'Driver License', value: 'driverslicense' },
                ]
            }
        },
        computed: mapState(['members', 'user']),
        mounted(){
            const id = this.user.memberID;
            this.$store.dispatch('fetchMembersNotIn', id);
        }
    }
</script>

<style scoped>

</style>
