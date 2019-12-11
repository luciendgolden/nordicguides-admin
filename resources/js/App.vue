<template>
    <v-app style="background: #eee;">
        <core-navbar/>
    </v-app>
</template>

<script>
    import CoreNavbar from "./components/core/CoreNavbar";

    export default {
        name: "App",
        created() {
        },
        components: { CoreNavbar }
    }
</script>

<style scoped>

</style>
