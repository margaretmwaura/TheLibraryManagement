<template>
    <v-container>
        <v-layout row>
            <v-flex md12>
                <p>Add a Book</p>
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

        <v-card class="pa-5" v-for="book in getallorderednreserved" :key="book.id">
            <v-layout row :class="`${checkBookStatus(book.borrow_date)}`">
                <v-flex xs12 md12 >
                    <div class="caption grey--text">Book Name</div>
                    <div>{{book.name}}</div>
                </v-flex>
                <v-flex xs6 sm2 md2>
                    <div class="cption grey--text">Book Reserve Date</div>
                    <div>{{book.borrow_date}}</div>
                </v-flex>
                <v-flex xs6 sm2 md2>
                    <div class="caption grey--text">Book Due Date</div>
                    <div>{{book.due_date}}</div>
                </v-flex>
                <v-flex xs6 sm2 md2>
                    <div class="caption grey--text">Book Borrow Date</div>
                    <div>{{book.order_date}}</div>
                </v-flex>
                <v-flex xs6 sm2 md2>
                    <div class="caption grey--text">Book Email</div>
                    <div>{{book.email}}</div>
                </v-flex>
                <v-flex xs6 sm2 md2>
                    <div class="caption grey--text">Book Return Date</div>
                    <div>{{book.return_date}}</div>
                </v-flex>
                <v-flex xs6 sm2 md2>
                    <div>Action</div>
                    <div>
                        <v-chip :class="`${checkBookStatus(book.borrow_date)}`" @click="returnbook(book)">{{checkActionToTake(book.borrow_date)}}</v-chip>
                    </div>
                </v-flex>
            </v-layout>
        </v-card>
    </v-container>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import {mapGetters} from "vuex";
    import { required, maxLength, email } from 'vuelidate/lib/validators'
    import notificationmixin from "../mixins/notificationmixin";
    export default {
        mixins: [validationMixin,notificationmixin],
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
                if(this.valid)
                {
                    this.$store.dispatch('addbook',this.form);
                }
                else
                {
                    this.informwithnotification("Fail" , "Ensure you fill all details");
                }

            },
            returnbook(book)
            {
                this.$store.dispatch('returnbook',book);
            },
            checkBookStatus(orderdate){

                if(orderdate === null)
                {
                    return "borrowed"
                }
                else
                {
                    return "ordered"
                }
            },
            checkActionToTake(orderdate)
            {
                if(orderdate === null)
                {
                    return "Return"
                }
                else
                {
                    return "Collect"
                }
            }

        },

        mounted() {
            this.$store.dispatch('getallorderedandreservedbooks');
        },

        watch: {
            '$store.state.addfail' : function () {
                console.log("The adding was a fail");
                this.informwithnotification("Fail" , "You have not added a book");
                this.$store.dispatch('clearAddFail');
            },
            '$store.state.addsuccess' : function () {
                console.log("The adding was successful");
                this.informwithnotification("Sucesss" , "You have  added a book");
                this.$store.dispatch('clearAddSuccess');
            },
        },

    }
</script>

<style scoped>
    .borrowed
    {
        border-left: 4px solid orange;
    }
    .ordered
    {
        border-left: 4px solid tomato;
    }
</style>
