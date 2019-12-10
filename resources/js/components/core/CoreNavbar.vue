<template>
    <v-app id="sandbox">
        <v-navigation-drawer
            v-model="primaryDrawer.model"
            app
            overflow
        >
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title class="title">
                        Application
                    </v-list-item-title>
                    <v-list-item-subtitle>
                        subtext
                    </v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <v-list
                dense
                nav
            >
                <v-list-item
                    v-for="item in items"
                    :key="item.title"
                    link
                >
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            app
        >
            <v-app-bar-nav-icon
                v-if="primaryDrawer.type !== 'permanent'"
                @click.stop="primaryDrawer.model = !primaryDrawer.model"
            />
            <v-toolbar-title>Vuetify</v-toolbar-title>
        </v-app-bar>

        <core-content/>

        <v-footer
            inset
            app
        >
            <span class="px-4">&copy; {{ new Date().getFullYear() }}</span>
        </v-footer>
    </v-app>
</template>

<script>
    import CoreContent from './CoreContent'

    export default {
        name: 'navbar',
        data: () => ({
            primaryDrawer: {
                model: null,
                type: 'default (no property)',
                floating: false,
                mini: false,
            },
            items: [
                {title: 'Dashboard', icon: 'mdi-view-dashboard'},
                {title: 'Photos', icon: 'mdi-image'},
                {title: 'About', icon: 'mdi-help-box'},
            ],
        }),
        components: {
            CoreContent
        }
    }
</script>
