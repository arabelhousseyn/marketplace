<template>
        <div id='sidee' class="side">
            <div class="divider"></div>
          <div class="container">
              <h1 class="title">Marketplace</h1>
              <div class="list">
               <router-link class="inf" to="/"><div class="container info"><i class="fa fa-home icon"></i> <span>Browse all</span></div></router-link>
               <router-link  v-if="auth != ''"  class="inf" to="/main/notification"><div class="container info"><i class="fa fa-bell icon"></i> <span>Notifications</span></div></router-link>
               <router-link  v-if="auth != ''" class="inf" to="/main/inbox"><div class="container info"><i class="fa fa-inbox icon"></i> <span>Inbox</span></div></router-link>
               <router-link  v-if="auth != ''"  class="inf" :to="`/main/profile/${auth.username}`"><div class="container info"><i class="fa fa-user icon"></i> <span>Your account</span></div></router-link>
               <div class="divider"></div>
               <div v-if="auth != ''" class="container"><a class="inf1" href='#' data-toggle="modal" data-target="#addListing"><div class="info1"><i class="fa fa-plus"></i> <span>Create New Listing</span></div></a></div>
               <div class="divider"></div>
               <div class="container">
                <h1 class="title">Categories</h1>
               </div>
               <router-link v-for="(category,index) in categories" :key="index" :to="'/main/category/' + category.id" class="inf"><div class="container info"><i :class="category.icon + ' icon'"></i> <span>{{category.title_en}}</span></div></router-link>
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
      auth : "",
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
    this.checkpath(this.$route.path.split('/')[2])
  },
  methods : {
    checkpath(value)
    {
      if(value != undefined)
      {
        if(value.trim('') == 'product')
      {
        document.getElementById('sidee').style.display = 'none'
      }
      }else{
        document.getElementById('sidee').style.display = 'block'
      }
    }
  },
  created()
  {
    this.auth = this.$store.state.auth
  },
  watch: {
    '$route.path': {
        handler(value) {
            this.checkpath(value.split('/')[2])
        },
        
    }
}
}
</script>