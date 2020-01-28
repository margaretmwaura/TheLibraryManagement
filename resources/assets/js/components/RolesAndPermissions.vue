<template>
    <v-container class="my-12">
        <h4 class="subheading grey--text">Roles and Permissions</h4>
<!--        If doesnt work add wrap to v-layout-->
        <v-layout row justify-space-around>
            <v-flex xs12 md5>
                <p>Add a permission</p>
                <v-form v-model="valid" ref="form" >
                    <v-text-field label="Permission" v-model="form.name" :rules="permRules" :counter="10"  color="purple darken-2" > </v-text-field>
                    <v-btn @click="addPermission" :class="{ red: !valid, blue: valid }">submit</v-btn>
                </v-form>
            </v-flex>
            <v-flex xs12 md5>
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
                    <v-select v-model="formAssign.permission" :items="getallPermissions"  :error-messages="selectErrors" label="Item"
                    > </v-select>
                    <v-btn class="mr-4" @click="assign">submit</v-btn>
                </form>
            </v-flex>
        </v-layout>

        <v-layout row justify-center>

                 <v-flex md3>
                    <v-card-title>The following are roles  -> </v-card-title>
                    <div v-for="role in getallRolesg">
                        <v-card-text>{{role}}</v-card-text>
                    </div>
                 </v-flex>
                <v-flex md5>
                    <v-card-title>The following are the permissions of the role</v-card-title>
                    <div v-for="perm in getallpermsroles">
                        <div v-for="one in perm" style="display: inline-block; margin-right: 30px">
                            <v-card-text>{{one}}</v-card-text>
                        </div>
                    </div>
                </v-flex>

        </v-layout>

            <v-card class="pa-5" v-for="user in getallUsersg" :key="user.id">
                <v-layout row :class="`${roleidname(user.role_id)}`">
                    <v-flex xs12 md6 >
                        <div class="caption grey--text">Name of user</div>
                        <div>{{user.id}}</div>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                        <div class="cption grey--text">User ID</div>
                        <div>{{user.name}}</div>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                        <div class="caption grey--text">User Role</div>
                        <div>{{roleidname(user.role_id)}}</div>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                        <div class="caption grey--text">Change Status</div>
                        <div>
                            <!--                        <v-chip small :class="`${roleidname(user.role_id)} white&#45;&#45;text caption my-2`">-->
                            <!--                        Change role status-->
                            <!--                       </v-chip>-->
                            <popup :user="user"></popup>
                        </div>
                    </v-flex>
                </v-layout>
            </v-card>


    </v-container>
</template>

<script>
    import Popup from "./Popup";
    import { validationMixin } from 'vuelidate'
    import { required, maxLength, email } from 'vuelidate/lib/validators'
    import {mapGetters} from "vuex";
    export default {
        components: {Popup},
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
                formChange:{},

            }
        },
        computed: {
            ...mapGetters(['getallPermissions','getallRolesg','getallpermsroles','getallUsersg']),
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
                console.log("This is the choosen permission " + this.formChange.role);
                this.$store.dispatch('toggleRoles',user);
            },
            roleidname(id)
            {
                if(id === 7)
                {
                    return "User";
                }
                if(id === 9)
                {
                    return "Admin";
                }
                if(id === 11)
                {
                    return "Normal"
                }
            },
            showSubscriptions() {
                console.log("Opening the modal " + this.showModal);
                this.showModal = true;
            },
        },
        mounted() {
            this.$store.dispatch('getallRolesPermissions');
            this.$store.dispatch('getallRoles');
            this.$store.dispatch('getallPermissions');
            this.$store.dispatch('getAllUsers');
        },
    }
</script>

<style scoped>
    .Admin
    {
        border-left: 4px solid #3cd1c2;
    }
    .User
    {
        border-left: 4px solid orange;
    }
    .Normal
    {
        border-left: 4px solid tomato;
    }

</style>
