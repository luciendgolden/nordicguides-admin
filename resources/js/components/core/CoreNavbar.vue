<template>
    <div class="nav">
        <v-navigation-drawer
            id="app-drawer"
            v-model="primaryDrawer.model"
            app
            dark
            :src="image"
            mobile-break-point="991"
            width="260"
        >

            <v-list-item>
                <v-list-item-icon>
                    <v-avatar color="white">
                        <img
                            :src="logo"
                            alt="logo"
                        >
                    </v-avatar>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title class="title">
                        Nordic Guides
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>

            <v-list
                dense
                nav
            >
                <v-list-item
                    class="ma-3"
                    v-for="item in items"
                    :key="item.title"
                    :to="item.path"
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
            flat
            style="background: #eee;"
        >
            <v-app-bar-nav-icon
                v-if="responsive"
                @click.stop="onClickBtn"
            >
            </v-app-bar-nav-icon>
            <v-toolbar-title class="ma-5 subtitle-1 font-weight-light">
                <span v-if="title">
                    {{ title }}
                </span>
                <span v-else>
                    Dashboard
                </span>
            </v-toolbar-title>
        </v-app-bar>

        <core-content/>

        <v-footer
            id="core-footer"
            color="#eee"
            inset
            app
            height="82"
        >
            <v-spacer/>
            <span class="font-weight-light copyright">
      &copy;
      {{ (new Date()).getFullYear() }}
      Lucien D. Golden, made with
      <v-icon
          color="tertiary"
          size="17">mdi-heart</v-icon>
      for a better web
    </span>
        </v-footer>
    </div>
</template>

<style lang="scss">
    .v-navigation-drawer__content {
        background: rgba(27, 27, 27, .74);
    }

    .v-navigation-drawer .v-list {
        background: none;
    }

    #app-drawer {
        .v-list__tile {
            border-radius: 4px;

            &--buy {
                margin-top: auto;
                margin-bottom: 17px;
            }
        }
    }

    #core-footer {
        z-index: 0;
    }
</style>

<script>
    import CoreContent from './CoreContent'

    export default {
        name: 'navbar',
        data: () => ({
            title: null,
            color: 'success',
            logo: 'https://res.cloudinary.com/dj4qfshsx/image/upload/v1575658748/nordicguides/favicon_r9mkuj.png',
            image: 'https://demos.creative-tim.com/vue-material-dashboard/img/sidebar-2.32103624.jpg',
            responsive: false,
            primaryDrawer: {
                model: null,
            },
            items: [
                {title: 'User Profile', path: '/user-profile', icon: 'dashboard'},
                {title: 'Members', path: '/members', icon: 'supervised_user_circle'},
                {title: 'Languages', path: '/languages', icon: 'language'},
                {title: 'Fees', path: '/fees', icon: 'payment'},
                {title: 'Logout', path: '/logout', icon: 'mdi-logout'},
            ],
        }),
        watch: {
            '$route'(val) {
                this.title = val.name
            }
        },
        mounted() {
            this.onResponsiveInverted()
            window.addEventListener('resize', this.onResponsiveInverted)
        },
        beforeDestroy() {
            window.removeEventListener('resize', this.onResponsiveInverted)
        },
        methods: {
            onClickBtn() {
                this.primaryDrawer.model = !this.primaryDrawer.model
            },
            onResponsiveInverted() {
                if (window.innerWidth < 991) {
                    this.responsive = true
                } else {
                    this.responsive = false
                }
            },
        },
        components: {
            CoreContent
        }
    }
</script>
