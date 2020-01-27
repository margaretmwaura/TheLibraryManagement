require('./bootstrap');
require('./components');
import store from "./appstore/store";
window.Vue = require('vue');
import Permissions from './mixins/Permissions';
import router from "./approuters/router";

import Vuetify from 'vuetify'
Vue.use(Vuetify);

const vuetify = new Vuetify();

import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'

Vue.use(VueMaterial);
Vue.mixin(Permissions);

const app = new Vue({
    router,
    store,
    el: '#root',
    vuetify
});
