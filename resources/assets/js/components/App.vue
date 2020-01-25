<template>
    <div>
        <router-link to="/add"> Add Book</router-link>
        <router-link to="/display"> Display books</router-link>
        <router-view></router-view>

    </div>

</template>

<script>
    export default {
        name: "App.vue",
    }
</script>

<style scoped>

</style>
