<template>
    <div class="main">
        <div v-if="edit">
            <auth-user />
        </div>
        <div v-else-if="!edit">
            <normal-user />
        </div>
    </div>
</template>

<script>
import authUser from '../components/authUser.vue'
import normalUser from '../components/normalUser.vue'
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
    created()
    {
        let username = this.$store.state.auth.username.trim()

        if(username.trim() == this.$route.params.username.trim())
        {
            this.edit = true
        }else{
            this.edit = false

        }
    }
}
</script>