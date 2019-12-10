<template>
    <v-content>
        <v-fade-transition mode="out-in">
            <router-view>
                <v-container fluid></v-container>
            </router-view>
        </v-fade-transition>
    </v-content>
</template>

<script>
    export default {}
</script>

<style scoped>

</style>
