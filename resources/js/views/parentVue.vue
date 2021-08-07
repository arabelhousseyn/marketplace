<template>
    <div class="main">
        <fixedbox-container @move="move" :path="path" :listings="listings" />
    </div>
</template>
<style>
.title{
    font-size: 30px;
}
</style>
<script>
import MoneyFormat from 'vue-money-format'
import axios from 'axios'
import fixedboxContainer from '../components/fixedboxContainer.vue'
export default {
    data : ()=>{
        return{
            listings : [],
            path : null,
        }
    },
    components : {
        'money-format': MoneyFormat,
        fixedboxContainer
    },
    methods : {
        move(value)
        {
            this.$router.push(`/main/product/${value.id}`)
        }
    },
    mounted()
    {
        this.path = this.$store.state.imagePath

        let run = axios.get('/api/listing',this.cors())
        run.then(e=>{
            this.listings = e.data
        })
    }
}
</script>
