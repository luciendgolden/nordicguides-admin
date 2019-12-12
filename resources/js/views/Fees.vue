<template>
    <v-container>
        <v-layout align-center justify-center>
            <v-data-table
                :headers="headers"
                :items="fees"
                :items-per-page="5"
                class="elevation-1"
            ></v-data-table>
        </v-layout>
    </v-container>
</template>

<script>
    /**
     * Show the Payment for the year
     * SELECT annualfee.year, annualfee.date, annualfee.amount, members.memberID, members.firstname, members.lastname
     * FROM annualfee
     * JOIN members ON members.memberID=annualfee.memberID WHERE year=2019
     */
    import {mapState} from 'vuex';

    export default {
        name: "Fees",
        data() {
            return {
                headers: [
                    {text: 'Year', value: 'year'},
                    {text: 'Basic Fee €', value: 'basicfee'},
                    {text: 'Due Date', value: 'duedate'},
                    {text: 'Extra Fee', value: 'extrafee'},
                ]
            }
        },
        computed: mapState(['fees']),
        mounted() {
            this.$store.dispatch('fetchFees');
        }
    }
</script>

<style scoped>

</style>
