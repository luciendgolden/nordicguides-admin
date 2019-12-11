<template>
    <div id="authorization">
        <v-app-bar app>
            <v-toolbar-title>Nordic Guides</v-toolbar-title>
            <v-spacer/>
            <div v-for="item in items"
                 :key="item.title">
                <v-btn class="ma-2 pa-3" tile large icon :to="item.path">
                    <v-icon>{{item.icon}}</v-icon>{{item.title}}
                </v-btn>
            </div>
        </v-app-bar>

        <authorization/>
    </div>
</template>

<script>
    import Authorization from "./Authorization";

    export default {
        name: "NotAuthorizedNav",
        data() {
            return {
                drawer: false,
                items: [
                    {title: 'Sign In', path: '/', icon: 'mdi-account'},
                    {title: 'Sign Up', path: '/register', icon: 'dashboard'},
                ]
            }
        },
        components: {
            Authorization
        }
    }
</script>

<style scoped>

</style>
