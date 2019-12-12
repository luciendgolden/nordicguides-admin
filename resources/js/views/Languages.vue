<template>
    <v-container>
        <v-layout align-center justify-center>
            <v-data-table
                :headers="headers"
                :items="languages"
                :items-per-page="5"
                class="elevation-1"
            ></v-data-table>
        </v-layout>
    </v-container>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        name: "Languages",
        data(){
            return {
                headers: [
                    { text: 'Language', value: 'language' },
                ]
            }
        },
        computed: mapState(['languages']),
        mounted(){
            this.$store.dispatch('fetchLanguages');
        }
    }
</script>

<style scoped>

</style>
