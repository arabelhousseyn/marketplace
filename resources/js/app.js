

import Vue from 'vue'


import common from './common'

Vue.mixin(common)
import router from './router/router';

import mainVue from './views/mainVue.vue'

import store from '../store'
import MoneyFormat from 'vue-money-format'


const app = new Vue({
    el: '#app',
    components : {
        mainVue,
    },
    router,
    store,
});
