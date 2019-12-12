<template>
    <v-container
        class="fill-height"
        fluid
    >
        <v-row
            align="center"
            justify="center"
        >
            <v-col
                cols="12"
                sm="8"
            >
                <v-card class="elevation-12">
                    <v-toolbar
                        color="success"
                        dark
                        flat
                    >
                        <v-toolbar-title>Login form</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form>
                            <v-text-field
                                v-model="user.firstname"
                                label="Firstname"
                                name="Firstname"
                                type="text"
                                prepend-icon="person"
                            />
                            <v-text-field
                                v-model="user.lastname"
                                label="Lastname"
                                name="Lastname"
                                type="text"
                                prepend-icon="person_outline"
                            />
                            <v-text-field
                                v-model="user.email"
                                label="Email"
                                name="Email"
                                type="text"
                                prepend-icon="email"
                            />

                            <v-text-field
                                v-model="user.password"
                                label="Password"
                                name="password"
                                type="password"
                                prepend-icon="lock"
                            />
                            <v-text-field
                                v-model="user.password2"
                                label="Confirm"
                                name="Confirm"
                                type="password"
                                prepend-icon="lock"
                            />
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer/>
                        <v-btn color="success" @click="checkForm">Register</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
        <v-snackbar v-model="snackbar.show"
                    :color="snackbar.color"
                    :timeout="snackbar.timeout"
                    top
        >
            {{ messages[0] }}
            <v-btn text @click="snackbar.show = false">
                Close
            </v-btn>
        </v-snackbar>
    </v-container>
</template>

<script>
    import Repository from "../service/repository";

    export default {
        name: "Register",
        data() {
            return {
                messages: [],
                snackbar: {
                    show: false,
                    color: '',
                    timeout: 6000,
                },
                user: {
                    firstname: null,
                    lastname: null,
                    email: null,
                    password: null,
                    password2: null,
                },
            }
        },
        methods: {
            checkForm(e) {
                if (this.user.firstname && this.user.lastname && this.user.email && this.user.password
                    && this.user.password2 && (this.user.password === this.user.password2)) {
                    const arr = [];

                    arr.push(this.user);

                    const newUser = arr.map(e => {
                        return {
                            firstname: e.firstname,
                            lastname: e.lastname,
                            email: e.email,
                            password: e.password
                        }
                    });

                    Repository.post('/register', ...newUser)
                        .then(res => res.data)
                        .then(() => this.$router.push('/'))
                        .catch();

                    return true;
                }

                this.messages = [];

                if (!this.user.firstname) {
                    this.messages.push('Firstname required.');
                }
                if (!this.user.lastname) {
                    this.messages.push('Lastname required.');
                }
                if (!this.user.email) {
                    this.messages.push('Email required.');
                }
                if (!this.user.password) {
                    this.messages.push('Password required.');
                }
                if (!this.user.password2) {
                    this.messages.push('Confirm Password required.');
                }
                if (this.user.password !== this.user.password2) {
                    this.messages.push('Password does not match.');
                }

                this.snackbar.color = 'error';
                this.snackbar.show = true;

                e.preventDefault();
            }
        }
    }
</script>

<style scoped>

</style>
