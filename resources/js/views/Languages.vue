<template>
    <v-container>
        <v-layout align-center justify-center>
            <v-data-table
                :headers="headers"
                :items="languages"
                :items-per-page="10"
                class="elevation-1"
            >
                <template v-slot:top>
                    <v-toolbar flat color="white">
                        <v-toolbar-title>Languages</v-toolbar-title>
                        <v-divider
                            class="mx-4"
                            inset
                            vertical
                        ></v-divider>
                        <v-spacer></v-spacer>
                        <v-dialog v-model="dialog" max-width="500px">
                            <template v-slot:activator="{ on }">
                                <v-btn color="success" dark class="mb-2" v-on="on">New Item</v-btn>
                            </template>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{ formTitle }}</span>
                                </v-card-title>

                                <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field v-model="editedItem.language"
                                                              label="Language"></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                    <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>
                <template v-slot:item.action="{ item }">
                    <!--
                    <v-icon
                        small
                        class="mr-2"
                        @click="editItem(item)"
                    >
                        edit
                    </v-icon>
                    -->
                    <v-icon
                        small
                        color="error"
                        @click="deleteItem(item)"
                    >
                        delete
                    </v-icon>
                </template>
                <template v-slot:no-data>
                    <v-btn color="primary">No data</v-btn>
                </template>
            </v-data-table>
        </v-layout>
    </v-container>
</template>

<script>
    import {mapState} from 'vuex';
    import repository from "../service/repository";

    export default {
        name: "Languages",
        data() {
            return {
                dialog: false,
                headers: [
                    {text: 'Language', value: 'language'},
                    {text: 'Actions', value: 'action', sortable: false},
                ],
                editedIndex: -1,
                editedItem: {
                    language: ''
                },
                defaultItem: {
                    language: ''
                },
            }
        },
        computed: {
            ...mapState(['languages']),
            formTitle() {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            },
        },
        watch: {
            dialog(val) {
                val || this.close()
            },
        },
        methods: {
            editItem(item) {
                this.editedIndex = this.languages.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem(item) {
                confirm('Are you sure you want to delete this item?') && this.$store.dispatch('deleteLanguage', item);
            },

            close() {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },

            save() {
                this.$store.dispatch('editLanguage', this.editedItem);

                this.close()
            }
        },
        mounted() {
            this.$store.dispatch('fetchLanguages');
        }
    }
</script>

<style scoped>

</style>
