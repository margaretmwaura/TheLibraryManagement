<template>
    <div>
        <form v-on:submit.prevent="edit">
            <p>Add a book to library</p>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="cell medium-12 large-12 small-12">
                        <label>Name
                            <input type="text" v-model="form.name">
                        </label>
                    </div>
                    <div class="cell medium-12 large-12 small-12">
                        <label>Category
                            <input type="text" v-model="form.category">
                        </label>
                    </div>
                    <div class="cell medium-12 large-12 small-12">
                        <label>Year of release
                            <input v-model="form.year" >
                        </label>
                    </div>
                    <div class="cell medium-12 large-12 small-12">
                        <label>Book Image Url
                            <input v-model="form.url" type="text">
                        </label>
                    </div>
                    <div class="cell medium-12 large-12 small-12">
                        <button class="primary button expanded">Create Book</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

    export default {
        name: "Edit_book",
        data() {
            return {
                form:{}
            }
        },
        methods: {
            edit() {
                this.$store.dispatch('addbook',this.form);
            }
        },
        created() {
            console.log("Edit has been called");

            this.book = this.$route.params.book;
            this.form.name = this.$route.params.book.name;
            this.form.category = this.$route.params.book.category;
            this.form.year = this.$route.params.book.year;
            this.form.url = this.$route.params.book.url;

        },
    }
</script>

<style scoped>

</style>

