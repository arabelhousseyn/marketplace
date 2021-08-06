

import Vue from 'vue'


import common from './common'

Vue.mixin(common)
import router from './router/router';

import mainVue from './views/mainVue.vue'

import store from '../store'

import * as VueGoogleMaps from 'vue2-google-maps'
 
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyDGy4IaSCDzTFd9eW7H1Iovy7xEc5sNOSE',
    libraries: 'places',
  },
 
})

const app = new Vue({
    el: '#app',
    components : {
        mainVue,
    },
    router,
    store,
});
