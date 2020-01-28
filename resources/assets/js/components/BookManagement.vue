<template>
    <v-container>
        <v-layout row>
            <v-flex md12>
                <p>Add a permission</p>
                <v-form v-model="valid" ref="form">
                    <v-text-field label="Book Name" v-model="form.name" :rules="nameRules" :counter="20"  color="purple darken-2" > </v-text-field>
                    <v-text-field label="Book category" v-model="form.category" :rules="categoryRules" :counter="10"  color="purple darken-2" > </v-text-field>
                    <v-text-field label="Release year" v-model="form.year" :rules="yearRules" :counter="10"  color="purple darken-2" > </v-text-field>
                    <v-text-field label="Book author" v-model="form.author" :rules="authorRules" :counter="10"  color="purple darken-2" > </v-text-field>
                    <v-textarea label="Book description" v-model="form.description" :rules="urlRules" :counter="200"  color="purple darken-2" > </v-textarea>
                    <v-btn @click="create" :class="{ red: !valid, blue: valid }">Add book </v-btn>
                </v-form>
            </v-flex>
        </v-layout>
        <v-layout row>
            <table class="table" v-for="books in getallorderednreserved">
                <tr>
                    <th>Book name</th>
                    <th> Book Category </th>
                    <th> Book Release year </th>
                    <th> Book Borrow Date </th>
                    <th>Book Due Date</th>
                    <th>Book Reserve date</th>
                    <th>Assoicated User </th>
                    <th>Return date</th>
                    <th>Return book</th>
                </tr>
                <tr v-for="book in books">
                    <td>{{book.name}}</td>
                    <td>{{book.category}}</td>
                    <td>{{book.year}}</td>
                    <td>{{book.borrow_date}}</td>
                    <td>{{book.due_date}}</td>
                    <td>{{book.reserve_date}}</td>
                    <td>{{book.pivot.email}}</td>
                    <td>{{book.return_date}}</td>
                    <td><button @click="returnbook(book)">Return book</button></td>
                </tr>

            </table>
        </v-layout>

        <v-card>
            <v-card-title>
                <h5>Add a new book to the library</h5>
            </v-card-title>
            <v-card-text>
               <v-form class="px-3">
                    <v-text-field label="Title" prepend-icon="edit">

                    </v-text-field>
               </v-form>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import {mapGetters} from "vuex";
    import { required, maxLength, email } from 'vuelidate/lib/validators'
    export default {
        mixins: [validationMixin],
        validations: {
            select: { required },
        },
        name: "BookManagement",
        data()
        {
            return{
                form:{},
                valid: false,
                valid_one: false,
                nameRules: [
                    (v) => !!v || 'A name is required',
                    (v) => v && v.length <= 20 || 'Name must be less than 10 characters'
                ],
                categoryRules: [
                    (v) => !!v || 'A category is required',
                    (v) => v && v.length <= 10 || 'Category must be less than 10 characters'
                ],
                yearRules: [
                    (v) => !!v || 'A year is required',
                    (v) => v && v.length <= 10 || 'Year must be less than 10 characters'
                ],
                authorRules: [
                    (v) => !!v || 'An author is required',
                    (v) => v && v.length <= 10 || 'Author must be less than 10 characters'
                ],
                urlRules: [
                    (v) => !!v || 'A description is required',
                    (v) => v && v.length <= 200 || 'Description must be less than 100 characters'
                ],
            }
        },
        computed: {
            ...mapGetters(['getallPermissions','getallRolesg','getallpermsroles','getallUsersg','getallorderednreserved']),
            selectErrors () {
                const errors = [];
                if (!this.$v.select.$dirty) return errors;
                !this.$v.select.required && errors.push('Item is required');
                return errors
            },

        },
        methods: {
            create() {
                this.$store.dispatch('addbook',this.form);
            },
            returnbook(book)
            {
                this.$store.dispatch('returnbook',book);
            }
        },
        mounted() {
            this.$store.dispatch('getallorderedandreservedbooks');
        },
    }
</script>

<style scoped>

</style>
