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
                                v-model="user.email"
                                label="Email"
                                name="Email"
                                prepend-icon="person"
                                type="text"
                            />

                            <v-text-field
                                v-model="user.password"
                                id="password"
                                label="Password"
                                name="password"
                                prepend-icon="lock"
                                type="password"
                            />
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer/>
                        <v-btn color="success" @click="login">Login</v-btn>
                    </v-card-actions>
                </v-card>

            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                user: {
                    email: null,
                    password: null,
                },
            }
        },
        methods: {
            login() {
                this.$store.dispatch('loginUser', this.user)
                    .then(() => this.$router.push({ path: 'user-profile' }))
                    .catch();
            }
        }
    }
</script>

<style scoped>

</style>
