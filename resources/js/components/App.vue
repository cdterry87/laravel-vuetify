<template>
    <div>
        <v-app class="inspire">
            <v-toolbar color="transparent" flat dense>
                <v-toolbar-title>
                    <a href="/home" class="headline logo">{{ title }}</a>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                    <v-btn text class="ml-2" @click="drawer = true">
                        <v-icon>mdi-menu</v-icon>
                        <span class="ml-3" v-if="$vuetify.breakpoint.mdAndUp">Menu</span>
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>

            <v-content>
                <v-navigation-drawer
                    light
                    v-model="drawer"
                    fixed
                    clipped
                    temporary
                    right
                >
                    <v-list flat>
                        <v-list-item link to="/home">
                            <v-list-item-content>
                                <v-list-item-title class="title">{{ title }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                    <v-divider></v-divider>
                    <v-list flat>
                        <v-list-item link to="/account">
                            <v-list-item-icon>
                                <v-icon>mdi-account-circle</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>My Account</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                </v-navigation-drawer>

                <router-view></router-view>

                <v-snackbar v-model="snackbar.enabled" :color="snackbar.color" :bottom="true" :timeout="snackbar.timeout">
                    {{ snackbar.message }}
                    <v-btn color="white" text @click="snackbar.enabled = false"><v-icon>mdi-close</v-icon></v-btn>
                </v-snackbar>
            </v-content>

            <div class="footer caption text-center mt-5 mb-3">
                {{ title }} &copy; 2019
            </div>
        </v-app>
    </div>
</template>

<script>
import Event from './../events'

export default {
    name: 'App',
    props: ['title'],
    data() {
        return {
            drawer: false,
            snackbar: {
                enabled: false,
                message: '',
                timeout: 5000,
                color: ''
            },
        }
    },
    created() {
        Event.$on('success', message => {
            this.snackbar.message = message
            this.snackbar.color = 'success'
            this.snackbar.enabled = true
        })
        Event.$on('warning', message => {
            this.snackbar.message = message
            this.snackbar.color = 'warning'
            this.snackbar.enabled = true
        })
        Event.$on('error', message => {
            this.snackbar.message = message
            this.snackbar.color = 'error'
            this.snackbar.enabled = true
        })
    }
}
</script>
