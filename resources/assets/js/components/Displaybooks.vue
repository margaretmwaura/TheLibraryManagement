<template>
    <div>
        <p>Will be displaying books in here </p>

        <div v-for="book in getBooks" class="grid-frame">
            <p style="margin-right: 30px"> {{book.name}} </p>
            <button v-on:click="deleting(book.id)" style="margin-right: 30px" v-if="$can('Delete')">Deleting a book </button>
            <button v-on:click="editting(book)" style="margin-right: 30px" v-if="$can('Edit')">Edit a book</button>
            <button style="margin-right: 30px" v-on:click="reserveBook(book)" v-if="$can('Reserve')">Reserve Book</button>
            <button style="margin-right: 30px" v-on:click="orderBook(book)" v-if="$can('Order')">Borrow Book</button>
        </div>


    </div>

</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "displaybooks",
        computed: {
            ...mapGetters(['getBooks'])
        },
        mounted() {
            this.$store.dispatch('getallbooks');
        },
        methods:{
            deleting(id)
            {
                console.log("Id of the deleting " + id);
                this.$store.dispatch('deleteABook',id);
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
            },
            orderBook(book)
            {
                this.$store.dispatch('orderBook',book);
            },
            reserveBook(book)
            {
                this.$store.dispatch('reserveBook',book);
            }
        }
    }
</script>

<style scoped>

</style>
