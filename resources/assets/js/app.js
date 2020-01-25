require('./bootstrap');
require('./components');
import store from "./appstore/store";
window.Vue = require('vue');
import Permissions from './mixins/Permissions';
import router from "./approuters/router";
Vue.mixin(Permissions);

const app = new Vue({
    router,
    store,
    el: '#root'
});
