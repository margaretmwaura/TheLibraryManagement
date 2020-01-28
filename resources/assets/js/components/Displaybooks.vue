
        <template>
            <v-container fluid>
                <v-data-iterator :items="getBooks" :items-per-page.sync="itemsPerPage" hide-default-footer>
                    <template v-slot:header>
                        <v-toolbar class="mb-2" color="indigo darken-5" dark flat>
                            <v-toolbar-title>This is a header</v-toolbar-title>
                        </v-toolbar>
                    </template>

                    <template v-slot:default="props">
                        <v-row>
                            <v-col v-for="item in props.items"  :key="item.name" cols="12" sm="6" md="4" lg="4">
                                <v-card>
                                    <v-card-title class="subheading font-weight-bold">{{ item.name }}</v-card-title>
                                    <v-divider></v-divider>
                                    <v-list dense>
                                        <v-list-item>
                                            <v-list-item-content>Category:</v-list-item-content>
                                            <v-list-item-content class="align-end">{{ item.category }}</v-list-item-content>
                                        </v-list-item>

                                        <v-list-item>
                                            <v-list-item-content>Description:</v-list-item-content>
                                            <v-list-item-content class="align-end">{{ item.description }}</v-list-item-content>
                                        </v-list-item>

                                        <v-list-item>
                                            <v-list-item-content>Release year:</v-list-item-content>
                                            <v-list-item-content class="align-end">{{ item.year }}</v-list-item-content>
                                        </v-list-item>

                                        <v-list-item>
                                            <v-list-item-content>Author:</v-list-item-content>
                                            <v-list-item-content class="align-end">{{ item.author }}</v-list-item-content>
                                        </v-list-item>
                                        <v-list-item>
                                            <Moreinfo :book="item"></Moreinfo>
                                        </v-list-item>

                                    </v-list>
                                </v-card>
                            </v-col>
                        </v-row>
                    </template>

                    <template v-slot:footer>
                        <v-row class="mt-2" align="center" justify="center">
                            <span class="grey--text">Items per page</span>
                            <v-menu offset-y>
                                <template v-slot:activator="{ on }">
                                    <v-btn dark text color="primary" class="ml-2" v-on="on">
                                        {{ itemsPerPage }}
                                        <v-icon>mdi-chevron-down</v-icon>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item v-for="(number, index) in itemsPerPageArray" :key="index" @click="updateItemsPerPage(number)">
                                        <v-list-item-title>{{ number }}</v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>

                            <v-spacer></v-spacer>

                            <span class="mr-4 grey--text">Page {{ page }} of {{ numberOfPages }}</span>
                            <v-btn fab dark color="blue darken-3" class="mr-1" @click="formerPage">
                                <v-icon>mdi-chevron-left</v-icon>
                            </v-btn>
                            <v-btn fab dark color="blue darken-3" class="ml-1" @click="nextPage">
                                <v-icon>mdi-chevron-right</v-icon>
                            </v-btn>
                        </v-row>
                    </template>
                </v-data-iterator>
            </v-container>
        </template>

<script>
    import {mapGetters} from "vuex";
    import Moreinfo from "./Moreinfo";

    export default {
        name: "displaybooks",
        components: {
                Moreinfo
            },
        computed: {
            ...mapGetters(['getBooks','getbookscount']),
            numberOfPages () {
                return Math.ceil(this.getBooks.length / this.itemsPerPage)
            },
            filteredKeys () {
                return this.keys.filter(key => key !== `Name`)
            },
        },
        mounted() {
            this.$store.dispatch('getallbooks');
            this.$store.dispatch('getallusersbooks');

        },
        methods:{

            nextPage () {
                if (this.page + 1 <= this.numberOfPages) this.page += 1
            },
            formerPage () {
                if (this.page - 1 >= 1) this.page -= 1
            },
            updateItemsPerPage (number) {
                this.itemsPerPage = number
            },
        },
        data()
        {
            return{
                itemsPerPageArray: [3, 6, 9 ,12],
                search: '',
                filter: {},
                sortDesc: false,
                page: 1,
                itemsPerPage: 3,
            }
        }
    }
</script>

<style scoped>

</style>
