<template>
     <div class="header">
       <header>
           <div class="mainContent">
               <div class="content">
                   <div class="logo">
                       <router-link style="text-decoration:none;color:white;" to="/"><h3>MarketPlace</h3></router-link>
                   </div>
                   <div class="search">
                       <div class="boxSearch">
                        <label for="search"><i class="fa fa-search"></i></label>
                        <input type="text" placeholder="Search" id="search">
                       </div>
                   </div>
                   <div class="trailing">
                       <div class="trail">
                        <a v-if="auth == ''" id="login" href="/login">Login</a>
                        <div v-else class="dropdown">
  <a style="text-decoration:none;color:white;" type="button" href="#" id="show" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{auth.fname}}
  </a>
  <div id='z23' class="dropdown-menu" aria-labelledby="show">
    <router-link class="dropdown-item" :to="`/main/profile/${auth.username}`">Profile</router-link>
    <router-link class="dropdown-item" to="/main/settings/">Settings</router-link>
    <a class="dropdown-item" @click="logout" href="#">Logout</a>
  </div>
</div>
                       </div>

                   </div>
               </div>
           </div>
       </header>
   </div>
</template>
<style>
#z23{
    position: fixed !important;
    left: 100% !important;
    transform: translate3d(-172px, 41px, 0px) !important;
}
</style>
<script>
import axios from 'axios'
export default {
    data :()=>{
        return{
            auth : "",
        }
    },
    methods : {
        logout()
        {
            
            let run = axios.post('/logout',this.cors())
            run.then(e=>{
                location.reload()
            })
        }
    },
    created()
    {
        this.auth = this.$store.state.auth
    }
}
</script>