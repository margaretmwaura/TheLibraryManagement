<template>
    <nav>
        <v-app-bar >
            <v-app-bar-nav-icon @click="drawer=!drawer">
            </v-app-bar-nav-icon>
            <v-toolbar-title>
                <span>Cytonn</span>
                <span class="font-weight-light">Libraries</span>
            </v-toolbar-title>
            <v-spacer>
            </v-spacer>
            <v-btn>
                <Span>Sign out</Span>
            </v-btn>
        </v-app-bar>
        <v-navigation-drawer temporary app class="indigo" v-model="drawer" >
            <v-list>
                <v-list-item v-for="item in links" :key="item.title" router :to="item.route">
                    <v-list-item-icon>
                        <v-icon class="white--text">{{ item.icon }}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title class="white--text">{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
    </nav>
</template>

<script>
    export default {
        name: "Navbar",
        data()
        {
            return{
                drawer:false,
                links: [
                    { title: 'Dashboard' , icon: 'mdi-view-dashboard',route : '/add'},
                    { title: 'Account' },
                    { title: 'Admin'},
                ],
            }
        }
    }
</script>

<style scoped>

</style>
