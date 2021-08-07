import Vue from 'vue'
import VueRouter from 'vue-router'
import categoryVue from '../views/categoryVue.vue'
import listingVue from '../views/listingVue.vue'
import profileVue from '../views/profileVue.vue'
Vue.use(VueRouter)

const routes = [
  {
    path : "/",
    name: "HomeVue",
    component: () => import(/* webpackChunkName: "home" */ '../views/parentVue.vue')
  },
  {
    path : "/main/category/:id",
    name: "categoryVue",
    component: categoryVue
  },
  {
    path : "/main/product/:id",
    name: "listingVue",
    component: listingVue
  },
  {
    path : "/main/profile/",
    name: "profileVue",
    component: profileVue
  },
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
