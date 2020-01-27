<template>
    <v-container>
        <v-layout row>
            <v-flex md5 sm12>
                <p>Add a permission</p>
                <v-form v-model="valid" ref="form" >
                    <v-text-field label="Permission" v-model="form.name" :rules="permRules" :counter="10"  color="purple darken-2" > </v-text-field>
                    <v-btn @click="addPermission" :class="{ red: !valid, blue: valid }">submit</v-btn>
                </v-form>
            </v-flex>
            <v-flex md2>

            </v-flex>
            <v-flex md5 sm12>
                <p>Add a Role</p>
                <v-form v-model="valid_one" ref="form">
                    <v-text-field label="Role" v-model="forma.name" :rules="roleRules" :counter="10" color="purple darken-2"> </v-text-field>
                    <v-btn @click="addRole" :class="{ red: !valid_one, blue: valid_one }">submit</v-btn>
                </v-form>
            </v-flex>
        </v-layout>
        <v-layout row>
            <v-flex md12>
                <h6 style="text-align: center">Add a role to a permission</h6>
                <form>
                    <v-select v-model="formAssign.role" :items="getallRolesg"  :error-messages="selectErrors" label="Item"
                              required>
                    </v-select>
                    <v-select v-model="formAssign.permission" :items="getallPermissions" v-bind:value="permission" :error-messages="selectErrors" label="Item"
                    > </v-select>
                    <v-btn class="mr-4" @click="assign">submit</v-btn>
                </form>
            </v-flex>
        </v-layout>
        <v-layout>
            <v-flex md5>
                <h6>The following are roles</h6>
                <div v-for="role in getallRolesg">
                    <p>{{role}}</p>
                </div>
            </v-flex>
            <v-flex md2>
            </v-flex>
            <v-flex md5>
                <h6>The following are the permissions of the role</h6>
                <div v-for="perm in getallpermsroles">
                    <div v-for="one in perm" style="display: inline-block; margin-right: 30px">
                        <p>{{one}}</p>
                    </div>
                </div>
            </v-flex>
        </v-layout>
        <v-layout>
            <v-flex>
                <table class="table">
                    <tr>
                        <th>User Id</th>
                        <th> User Name </th>
                        <th> User Role </th>
                        <th>Change Role</th>
                    </tr>
                    <tr v-for="user in getallUsersg">
                        <td>{{user.id}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.role_id}}</td>
                        <td><button v-on:click="togglingPermissions(user)">Toggle Role</button></td>
                    </tr>
                </table>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import { required, maxLength, email } from 'vuelidate/lib/validators'
    import {mapGetters} from "vuex";
    export default {
        mixins: [validationMixin],
        validations: {
            select: { required },
        },
        name: "RolesAndPermissions",
        data()
        {
            return{
                valid: false,
                valid_one: false,
                permRules: [
                    (v) => !!v || 'A permission is required',
                    (v) => v && v.length <= 10 || 'Permission must be less than 2 characters'
                ],
                roleRules: [
                    (v) => !!v || 'A role is required',
                    (v) => v && v.length <= 10 || 'Role must be less than 2 characters'
                ],
                // This is data that doesnt interact with the validations
                form:{},
                forma:{},
                formAssign:{},

            }
        },
        computed: {
            ...mapGetters(['getallPermissions','getallRolesg','getallpermsroles','getallUsersg','getallorderednreserved']),
            selectErrors () {
                const errors = [];
                if (!this.$v.select.$dirty) return errors
                !this.$v.select.required && errors.push('Item is required')
                return errors
            },
        },
        methods: {
            addPermission()
            {
                console.log("Adding permissions");
                this.$store.dispatch('addPermission',this.form);
            },
            addRole() {
                console.log("Adding roles");
                this.$store.dispatch('addRole',this.forma);
            },
            assign()
            {
                console.log("What we will be using for the assigning" + this.formAssign);
                this.$store.dispatch('assignPermissionToRole',this.formAssign);
            },
            togglingPermissions: function(user)
            {
                this.$store.dispatch('toggleRoles',user);
            }
        },
        mounted() {
            this.$store.dispatch('getallRolesPermissions');
            this.$store.dispatch('getallRoles');
            this.$store.dispatch('getallPermissions');
            this.$store.dispatch('getAllUsers');
            this.$store.dispatch('getallorderedandreservedbooks');
        },
    }
</script>

<style scoped>

</style>
