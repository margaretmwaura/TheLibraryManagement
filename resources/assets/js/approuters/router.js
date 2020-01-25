import Add_book from "../components/Add_book";
import Edit_book from "../components/Edit_book";
import Displaybooks from "../components/Displaybooks";
import Dashboard from "../components/Dashboard";
import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);


const routes = [
    {
        name : 'Add',
        path: '/add',
        component: Add_book,

    },
    {
        name : 'Display',
        path: '/display',
        component: Displaybooks,

    },
    {
        name : 'Edit',
        path: '/edit',
        component: Edit_book,

    },
    {
        name : 'DashBoard',
        path: '/dashboard',
        component: Dashboard,

    },
];

const router = new VueRouter({
    routes
});

export default router;
