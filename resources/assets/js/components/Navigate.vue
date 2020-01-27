<template>
<v-app>
    <Navbar></Navbar>
    <v-content>
        <router-view></router-view>
    </v-content>
</v-app>
</template>

<script>
    import Navbar from "./Navbar";
    export default {
        components: {Navbar},
        data () {
            return {
                items: [
                    { title: 'Dashboard', icon: 'dashboard' },
                    { title: 'Account', icon: 'account_box' },
                    { title: 'Admin', icon: 'gavel' },
                ],
            }
        },
    }
</script>
