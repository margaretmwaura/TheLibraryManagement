import Vue from 'vue'
import Vuex from 'vuex'
import axios from "axios";
Vue.use(Vuex);
export default new Vuex.Store({

    state: {
        books:[]
    },
    mutations: {
        setPermissionmut(permission)
        {
            this.state.permissions = permission
        },
        addbookmut(state,data)
        {
            console.log(data);
            axios
                .post('/books',data)
                .then(response => {
                    var code = response.status;
                    if(code === 200)
                    {

                    }
                })
                .catch(error =>
                {
                })
        },
        addPermissionmut(state,data)
        {
            console.log(data);
            axios
                .post('/permissions',data)
                .then(response => {
                    var code = response.status;
                    if(code === 200)
                    {

                    }
                })
                .catch(error =>
                {
                })
        },
        addRolemut(state,data)
        {
            console.log(data);
            axios
                .post('/roles',data)
                .then(response => {
                    if(code === 200)
                    {

                    }
                })
                .catch(error =>
                {
                })
        },
        getallbooksmut()
        {
            axios.get('/books')
                .then(response => {
                    this.state.books = response.data;
                    console.log("This is the data I have gotten " + this.books)
                })
                .catch(error =>
                {
                })
        },
        deleteABookMut(state,id)
        {
            axios
                .delete('/books/' + id,{
                })
                .then(response => {
                    const code = response.status;
                    if(code === 200)
                    {

                    }
                })
                .catch(error =>
                {

                })
        },


        },
    getters:
        {
            getBooks: state => {
                return state.books
            },
        },
    actions:
        {
            setPermission({commit},permissions)
            {
                commit('setPermissionmut',permissions)
            },
            addbook(state,data)
            {
                // console.log("What I am passing to the database " + name + " " + category + "year of release "  + year + " the url" + url);
                state.commit('addbookmut',data)
            },
            getallbooks(state)
            {
                state.commit('getallbooksmut')
            },
            deleteABook(state,id)
            {
                state.commit('deleteABookMut',id)
            },
            addPermission(state,data)
            {
                state.commit('addPermissionmut',data)
            },
            addRole(state,data)
            {
                state.commit('addRolemut',data)
            }


        },


});
