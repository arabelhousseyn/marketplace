<template>
    <div class="main">
        <fixedbox-container @move="move" :path="path" :listings="listings" />
        <div class="sizedBox" style="height:20px;"></div>
        <div v-for="(data,index) in listingsByCategory" :key="index">
        <dynamicbox-container @move="move" :path="path" :data="data" />
        </div>
        <div class="sizedBox" style="height:20px;"></div>
        <infinite-loading spinner='spiral' @infinite="infiniteHandler">
            <div slot="no-more"><button @click="reload" class="btn btn-primary"><i class="fa fa-sync-alt"></i></button></div>
            <div slot="no-results"><button @click="reload" class="btn btn-primary"><i class="fa fa-sync-alt"></i></button></div>
        </infinite-loading>
    </div>
</template>
<style>
.title{
    font-size: 30px;
}
</style>
<script>
import axios from 'axios'
import fixedboxContainer from '../components/fixedboxContainer.vue'
import dynamicboxContainer from '../components/dynamicboxContainer.vue'
import InfiniteLoading from 'vue-infinite-loading'
export default {
    data : ()=>{
        return{
            listings : [],
            path : null,
            listingsByCategory : [],
            page : 1,
        }
    },
    components : {
        fixedboxContainer,
        dynamicboxContainer,
        InfiniteLoading
    },
    methods : {
        move(value)
        {
            this.$router.push(`/main/product/${value.id}`)
        },
        reload()
        {
            location.reload()
        },
        infiniteHandler($state) {
      axios.get(`/api/getListingByCategory/?page=${this.page}`,this.cors()).then(({ data }) => {
        if (data.data.length) {
          this.page += 1;
          this.listingsByCategory.push(...data.data);
          $state.loaded();
        } else {
          $state.complete();
        }
      });
    },
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
