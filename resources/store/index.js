import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
     categories : [],
     Allproducts : [],
     productsByCategory : [],
     imagePath : 'http://hocine.marketplace/storage/app/public/listing/'
  },
  getters : {
  },
  mutations: {
    setCategories(state,payload)
    {
      return state.categories.push(...payload)
    }
  },
  actions: {
  },
  modules: {
  }
})
