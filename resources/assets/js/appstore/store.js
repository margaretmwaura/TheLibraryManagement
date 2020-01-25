import Vue from 'vue'
import Vuex from 'vuex'
import axios from "axios";
Vue.use(Vuex);
export default new Vuex.Store({

    state: {
        books:[],
        permissions:[],
        roles:[],
        permsroles:[]
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
        getallPermissionsmut()
        {
            axios.get('/permissions')
                .then(response => {
                    this.state.permissions = response.data;
                    console.log("This is the data I have gotten in regards to permissions " + this.books)
                })
                .catch(error =>
                {
                })
        },
        getallRolesmut()
        {
            axios.get('/roles')
                .then(response => {
                    this.state.roles = response.data;
                    console.log("This is the data I have gotten in regards to roles " + this.books)
                })
                .catch(error =>
                {
                })
        },
        getallRolesPermissionsmut()
        {
            axios.get('/allperms')
                .then(response => {
                    this.state.permsroles = response.data;
                    console.log("This is the data I have gotten in regards to roles " + this.books)
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
            getallPermissions:state => {
                return state.permissions
            },
            getallRolesg:state => {
                return state.roles
            },
            getallpermsroles:state => {
                return state.permsroles;
            }
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
            },
            getallPermissions(state)
            {
                state.commit('getallPermissionsmut')
            },
            getallRoles(state)
            {
                state.commit('getallRolesmut')
            },
            getallRolesPermissions(state)
            {
                state.commit('getallRolesPermissionsmut');
            }

        },


});
