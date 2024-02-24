require('./bootstrap');

import Vue from 'vue'
//import VueRouter from 'vue-router'
import * as VueRouter from 'vue-router'

Vue.use(VueRouter)


//import routes from './router'

Vue.component('navigation', require('./components/Navigation').default);



import router from './router'
const app = new Vue({
    el: '#app',
    router: router,
});