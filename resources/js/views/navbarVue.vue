<template>
     <div class="header">
       <header>
           <div class="mainContent">
               <div class="content">
                   <div class="logo">
                       <h2>MarketPlace</h2>
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
                        <a v-else href="/profile">{{auth.fname}}</a>
                       </div>
                   </div>
               </div>
           </div>
       </header>
   </div>
</template>

<script>
export default {
    data :()=>{
        return{
            auth : "",
        }
    },
    created()
    {
        this.auth = this.$store.state.auth
    }
}
</script>