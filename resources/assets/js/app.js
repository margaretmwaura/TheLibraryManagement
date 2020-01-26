require('./bootstrap');
require('./components');
import store from "./appstore/store";
window.Vue = require('vue');
import Permissions from './mixins/Permissions';
import router from "./approuters/router";
// import Vuetify from "../../plugins/vuetify";
// import Vuetify from 'vuetify'
// Vue.use(Vuetify);

import Vuetify from 'vuetify'
Vue.use(Vuetify);

const vuetify = new Vuetify();
Vue.mixin(Permissions);

const app = new Vue({
    router,
    store,
    el: '#root',
    vuetify
});
