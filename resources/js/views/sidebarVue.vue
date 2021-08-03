<template>
        <div class="side">
            <div class="divider"></div>
          <div class="container">
              <h1 class="title">Marketplace</h1>
              <div class="list">
               <a class="inf" href="/"><div class="container info"><i class="fa fa-home icon"></i> <span>Browse all</span></div></a>
               <router-link class="inf" to="/notification"><div class="container info"><i class="fa fa-bell icon"></i> <span>Notifications</span></div></router-link>
               <router-link class="inf" to="/inbox"><div class="container info"><i class="fa fa-inbox icon"></i> <span>Inbox</span></div></router-link>
               <router-link class="inf" to="/account"><div class="container info"><i class="fa fa-user icon"></i> <span>Your account</span></div></router-link>
               <div class="divider"></div>
               <div class="container"><a class="inf1" href=""><div class="info1"><i class="fa fa-plus"></i> <span>Create New Listing</span></div></a></div>
               <div class="divider"></div>
               <div class="container">
                <h1 class="title">Categories</h1>
               </div>
               <a v-for="(category,index) in categories" :key="index" :href="'/category/' + category.id" class="inf"><div class="container info"><i :class="category.icon + ' icon'"></i> <span>{{category.title_en}}</span></div></a>
              </div>
          </div>
        </div>
</template>

<script>
import axios from 'axios'
export default {
  data :()=>{
    return{
      categories : null,
    }
  },
  mounted()
  {
    var run = axios.get('/api/categories',this.cors());
    run.then(e=>{
      if(e.status == 200)
      {
        this.$store.commit('setCategories',e.data)
        this.categories = this.$store.state.categories
      }
    })
  }
}
</script>