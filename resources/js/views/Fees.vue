<template>
    <v-container>
        <v-layout align-center justify-center>

            <v-bottom-sheet v-model="feeDrawer">
                <v-sheet class="text-center">
                    <v-btn
                        class="mt-6"
                        text
                        color="red"
                        @click="feeDrawer = !feeDrawer"
                    >close</v-btn>
                    <v-row>
                        <v-col cols="12">
                            <v-data-table
                                :headers="payedFeesheaders"
                                :items="payedFees"
                                :items-per-page="5"
                                class="elevation-1"
                            >
                            </v-data-table>
                        </v-col>
                    </v-row>
                </v-sheet>
            </v-bottom-sheet>


            <v-data-table
                :headers="headers"
                :items="fees"
                :items-per-page="5"
                class="elevation-1"
            >
                <template v-slot:top>
                    <v-toolbar flat color="white">
                        <v-toolbar-title>Fees</v-toolbar-title>
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
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field v-model="editedItem.year"
                                                              label="Basic Fee"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field v-model="editedItem.basicfee"
                                                              label="Basic Fee"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-menu
                                                    :close-on-content-click="false"
                                                    :nudge-right="40"
                                                    transition="scale-transition"
                                                    offset-y
                                                    min-width="290px"
                                                >
                                                    <template v-slot:activator="{ on }">
                                                        <v-text-field
                                                            v-model="editedItem.duedate"
                                                            label="Due Date"
                                                            prepend-icon="date_range"
                                                            readonly
                                                            :rules="[v => !!v || 'Date is required']"
                                                            v-on="on"
                                                        ></v-text-field>
                                                    </template>
                                                    <v-date-picker
                                                        color="success"
                                                        v-model="editedItem.duedate"
                                                    ></v-date-picker>
                                                </v-menu>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field v-model="editedItem.extrafee"
                                                              label="Extra Fee"></v-text-field>
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
                    <v-icon
                        small
                        color="primary"
                        class="mr-2"
                        @click="editItem(item)"
                    >
                        edit
                    </v-icon>
                </template>
                <template v-slot:item.payment="{ item }">
                    <v-btn
                        text
                        small
                        color="success"
                        class="mr-2"
                        @click="showPayedFees(item)"
                    >
                        show
                    </v-btn>
                </template>
                <template v-slot:no-data>
                    <v-btn color="primary" @click="initialize">Reset</v-btn>
                </template>
            </v-data-table>
        </v-layout>
    </v-container>
</template>

<script>
    import Repository from "../service/repository";

    export default {
        name: "Fees",
        data() {
            return {
                feeDrawer: false,
                dialog: false,
                fees: [],
                headers: [
                    {text: 'Year', value: 'year'},
                    {text: 'Basic Fee €', value: 'basicfee'},
                    {text: 'Due Date', value: 'duedate'},
                    {text: 'Extra Fee', value: 'extrafee'},
                    {text: 'Actions', value: 'action', sortable: false},
                    {text: 'Show Payment', value: 'payment', sortable: false},
                ],
                payedFeesheaders: [
                    {text: 'Year', value: 'year'},
                    {text: 'Date', value: 'date'},
                    {text: 'Amount', value: 'amount'},
                    {text: 'Member ID', value: 'memberID'},
                    {text: 'First Name', value: 'firstname'},
                    {text: 'Last Name', value: 'lastname'},
                ],
                payedFees: [],
                editedIndex: -1,
                editedItem: {
                    year: new Date().toISOString().substr(0, 4),
                    basicfee: 0,
                    duedate: new Date().toISOString().substr(0, 10),
                    extrafee: 0,
                },
                defaultItem: {
                    year: new Date().toISOString().substr(0, 4),
                    basicfee: 0,
                    duedate: new Date().toISOString().substr(0, 10),
                    extrafee: 0,
                },
            }
        },
        methods: {
            initialize() {
                Repository.get('/fees')
                    .then(res => res.data)
                    .then(data => {
                        this.fees = data;
                    })
                    .catch(err => console.log(err));
            },
            editItem(item) {
                this.editedIndex = this.fees.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem(item) {
                const index = this.fees.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.fees.splice(index, 1)
            },

            close() {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },

            save() {
                // update existig Item in fees Collection
                if (this.editedIndex > -1) {
                    Object.assign(this.fees[this.editedIndex], this.editedItem)
                }
                // create new Item
                else {
                    this.fees.push(this.editedItem)
                }

                this.saveFeeToDb();
                this.close()
            },
            saveFeeToDb() {
                if (this.editedIndex > -1) {
                    const primaryKey = this.editedItem.year;

                    const baseDomain = 'http://nordicguides-admin.test';
                    const baseURL = `${baseDomain}/api/fees/${primaryKey}`;

                    const url = new URL(baseURL);
                    const params = this.editedItem;
                    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))

                    fetch(url, {
                        method: 'PUT'
                    })
                        .then(res => res.json)
                        .catch(err => console.log(err));
                } else {
                    Repository.post('/fees', this.editedItem)
                        .then(res => res.json)
                        .catch(err => console.log(err));
                }
            },
            showPayedFees(item) {
                this.editedIndex = this.fees.indexOf(item)
                this.editedItem = Object.assign({}, item)

                const year = this.editedItem.year;
                Repository.get(`/fees/${year}`)
                    .then(res => res.data)
                    .then(data => this.payedFees = data)
                    .catch(err => console.log(err));

                this.feeDrawer = true;
            }
        },
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            },
        },
        watch: {
            dialog(val) {
                val || this.close()
            },
        },

        created() {
            this.initialize();
        }
    }
</script>

<style scoped>

</style>
