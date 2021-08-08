<template>
    <div class="main">
        <div v-if="edit">
            <auth-user @move='move' :data="data" />
        </div>
        <div v-else-if="!edit">
            <normal-user @move='move' :data="data" />
        </div>
    </div>
</template>

<script>
import authUser from '../components/authUser.vue'
import normalUser from '../components/normalUser.vue'
import axios from 'axios'
export default {
    data :()=>{
        return{
            data : null,
            edit : false,
        }
    },
    components : {
        authUser,
        normalUser
    },
    methods : {
         check(value)
        {
        let username = this.$store.state.auth.username.trim()
        this.edit = (username.trim() == value.username.trim()) ? true : false
        this.handling(value.username.trim())
        },
        handling(param)
        {
            let run = axios.get(`/api/listingsByUser/${param}`,this.cors())
         run.then(e=>{
            this.data = e.data
        })
        run.catch(e=>{
            console.log(e.reseponse)
        })
        },
        move(listing)
        {
            this.$router.push(`/main/product/${listing.id}`)
        }
    },
     mounted()
    {
        let username = this.$store.state.auth.username.trim()
        this.edit = (username.trim() == this.$route.params.username.trim()) ? true : false
        this.handling(this.$route.params.username.trim())
    },
    watch : {
        '$route.params' : {
            handler(value) {
            this.check(value)
        },
        }
    }
}
</script>