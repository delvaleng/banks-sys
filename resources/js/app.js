require('./bootstrap');

window.Vue = require('vue').default;

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
window.Vue.use(Vuetify);

import router from './routes'

import Vuex from 'vuex'
Vue.use(Vuex)


Vue.component('app', require('./components/App.vue').default);

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(),
    icons: {
        iconfont: 'mdi'
    },
});
