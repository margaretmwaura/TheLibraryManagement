<template>
    <div class="text-center">
        <v-dialog v-model="dialog" width="500">
            <template v-slot:activator="{ on }">
                <v-btn class="ma-2" outlined color="indigo" dark v-on="on">Read More</v-btn>
            </template>
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>
                  {{book.name}}
                </v-card-title>
                <v-card-text>
                  {{book.description}}
                </v-card-text>
                <v-card-text>
                    Author : {{book.author}}
                </v-card-text>
                <v-card-text>
                   Category :  {{book.category}}
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn v-on:click="deleting(book.id)"  v-if="$candelete('Order',book.status_id)">Delete</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn v-on:click="editting(book)"  v-if="$canedit('Order',book.status_id)">Edit </v-btn>
                    <v-spacer></v-spacer>
                        <v-btn v-on:click="reserveBook(book)" v-if="$canreserve('Order',book.status_id)">Reserve </v-btn>
                    <v-spacer></v-spacer>
                        <v-btn  v-on:click="orderBook(book)" v-if="$canborrow('Order',book.status_id)">Borrow </v-btn>
                    <v-spacer></v-spacer>
                    <v-divider></v-divider>
                    <v-btn color="primary" text @click="togglingPermissions">
                        Close
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
    import {mapGetters} from "vuex";

    export default {
        name: "Popup",
        data()
        {
            return{
                dialog:false,
                formAssign:{}
            }
        },
        computed: {
            ...mapGetters(['getallRolesg']),
        },
        props: {
            book: Array,
        },
        methods: {
            togglingPermissions: function(user)
            {
                this.dialog = false;
            },
            deleting(id)
            {
                console.log("Id of the deleting " + id);
                this.$store.dispatch('deleteABook',id);
                this.dialog = false;
            },
            editting(book)
            {
                console.log("We want to edit the blog");
                this.$router.push({
                    name: 'Edit',
                    params: {
                        book: book,
                    }
                });
                this.dialog = false;
            },
            orderBook(book)
            {
                this.$store.dispatch('orderBook',book);
                this.dialog = false;
            },
            reserveBook(book)
            {
                console.log("A book has been reserved");
                this.$store.dispatch('reserveBook',book);
                this.dialog = false;
            },
            show_reserve(id)
            {
                if(id === 2)
                {
                    return true;
                }
                else
                {
                    return false
                }
            },
            show_borrow(id)
            {
                if(id === 1)
                {
                    return true;
                }
                else
                {
                    return false
                }
            }
        }
    }
</script>

<style scoped>

</style>

