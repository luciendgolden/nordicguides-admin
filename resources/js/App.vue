<template>
    <v-app style="background: #eee;">
        <div v-if="loggedIn">
            <core-navbar/>
        </div>
        <div v-else>
            <not-authorized-nav/>
        </div>
    </v-app>
</template>

<script>
    import { mapState } from 'vuex';

    import CoreNavbar from "./components/core/CoreNavbar";
    import NotAuthorizedNav from "./components/core/NotAuthorizedNav";

    export default {
        name: "App",
        computed: mapState(['loggedIn']),
        components: {CoreNavbar, NotAuthorizedNav}
    }
</script>

<style scoped>

</style>
