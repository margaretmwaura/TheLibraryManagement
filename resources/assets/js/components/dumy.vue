<!--                    <template v-slot:footer>-->
<!--                        <v-row class="mt-2" align="center" justify="center">-->
<!--                            <span class="grey&#45;&#45;text">Items per page</span>-->
<!--                            <v-menu offset-y>-->
<!--                                <template v-slot:activator="{ on }">-->
<!--                                    <v-btn dark text color="primary" class="ml-2" v-on="on">-->
<!--                                        {{ itemsPerPage }}-->
<!--                                        <v-icon>mdi-chevron-down</v-icon>-->
<!--                                    </v-btn>-->
<!--                                </template>-->
<!--                                <v-list>-->
<!--                                    <v-list-item v-for="(number, index) in itemsPerPageArray" :key="index" @click="updateItemsPerPage(number)">-->
<!--                                        <v-list-item-title>{{ number }}</v-list-item-title>-->
<!--                                    </v-list-item>-->
<!--                                </v-list>-->
<!--                            </v-menu>-->

<!--                            <v-spacer></v-spacer>-->

<!--                            <span class="mr-4 grey&#45;&#45;text">Page {{ page }} of {{ numberOfPages }}</span>-->
<!--                            <v-btn fab dark color="blue darken-3" class="mr-1" @click="formerPage">-->
<!--                                <v-icon>mdi-chevron-left</v-icon>-->
<!--                            </v-btn>-->
<!--                            <v-btn fab dark color="blue darken-3" class="ml-1" @click="nextPage">-->
<!--                                <v-icon>mdi-chevron-right</v-icon>-->
<!--                            </v-btn>-->
<!--                        </v-row>-->
<!--                    </template>-->


<!--:items-per-page.sync="itemsPerPage" &ndash;&gt;-->
