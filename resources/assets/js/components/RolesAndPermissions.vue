<template>
    <v-container>
        <v-layout row>
            <v-flex md5 sm12>
                <p>Add a permission</p>
                <v-form v-model="valid" ref="form">
                    <v-text-field label="Permission" v-model="perm" :rules="permRules" :counter="2"  color="purple darken-2" > </v-text-field>
                    <v-btn @click="submit" :class="{ red: !valid, blue: valid }">submit</v-btn>
                </v-form>
            </v-flex>
            <v-flex md2>

            </v-flex>
            <v-flex md5 sm12>
                <p>Add a Role</p>
                <v-form v-model="valid_one" ref="form">
                    <v-text-field label="Role" v-model="role" :rules="roleRules" :counter="2" color="purple darken-2"> </v-text-field>
                    <v-btn @click="submit" :class="{ red: !valid_one, blue: valid_one }">submit</v-btn>
                </v-form>
            </v-flex>
        </v-layout>
        <v-layout row>
            <v-flex md12>
                <h6 style="text-align: center">Add a role to a permission</h6>
                <form>
                    <v-select v-model="select" :items="items" :error-messages="selectErrors" label="Item"
                              required @change="$v.select.$touch()" @blur="$v.select.$touch()"> </v-select>
                    <v-btn class="mr-4" @click="submit">submit</v-btn>
                </form>
            </v-flex>
        </v-layout>
        <v-layout row>
            <v-flex md12>
                <v-data-table></v-data-table>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import { required, maxLength, email } from 'vuelidate/lib/validators'
    export default {
        mixins: [validationMixin],
        validations: {
            select: { required },
        },
        name: "RolesAndPermissions",
        data()
        {
            return{
                perm:'',
                role:'',
                valid: false,
                valid_one: false,
                permRules: [
                    (v) => !!v || 'A permission is required',
                    (v) => v && v.length <= 2 || 'Permission must be less than 2 characters'
                ],
                roleRules: [
                    (v) => !!v || 'A role is required',
                    (v) => v && v.length <= 2 || 'Role must be less than 2 characters'
                ],
            }
        },
        computed: {
            selectErrors () {
                const errors = []
                if (!this.$v.select.$dirty) return errors
                !this.$v.select.required && errors.push('Item is required')
                return errors
            },
        },
        methods: {
            submit () {
                this.$v.$touch()
            },
        },
    }
</script>

<style scoped>

</style>
