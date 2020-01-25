<template>
    <div>
        <p>Will be displaying books in here </p>

        <div v-for="book in getBooks">
            {{book.name}}
            <button v-on:click="deleting(book.id)">Deleting a book </button>
            <button v-on:click="editting(book)">Edit a book</button>
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
            }
        }
    }
</script>

<style scoped>

</style>
