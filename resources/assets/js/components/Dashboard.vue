<template>
    <div>

        <p>Adding a role </p>
        <form v-on:submit.prevent="addRole">
            <p>Add a role</p>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="cell medium-12 large-12 small-12">
                        <label>Name
                            <input type="text" v-model="roleName">
                        </label>
                    </div>
                    <div class="cell medium-12 large-12 small-12">
                        <button class="primary button expanded">Add role</button>
                    </div>
                </div>
            </div>
        </form>

        <p>Adding a permission</p>
        <form v-on:submit.prevent="addPermission">
            <p>Add a role</p>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="cell medium-12 large-12 small-12">
                        <label>Name
                            <input type="text" v-model="permissionName">
                        </label>
                    </div>
                    <div class="cell medium-12 large-12 small-12">
                        <button class="primary button expanded">Add permission</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
    export default {
        name: "Dashboard",
        data() {
            return {
                roleName: ' ',
                permissionName : ' '
            }
        },
        methods: {
            addRole() {
                console.log("Adding roles");
                this.$store.dispatch('addRole',this.roleName);
            },
            addPermission()
            {
                console.log("Adding permissions");
                this.$store.dispatch('addPermission',this.permissionName);
            }
        },
    }
</script>

<style scoped>

</style>
