<template>
    <v-container>
        <v-layout align-center justify-center>
            <v-data-table
                :headers="headers"
                :items="members"
                :items-per-page="5"
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
                    { text: 'Firstname', value: 'firstname' },
                    { text: 'Lastname', value: 'lastname' },
                ]
            }
        },
        computed: mapState(['members']),
        mounted(){
            this.$store.dispatch('fetchMembers');
        }
    }
</script>

<style scoped>

</style>
