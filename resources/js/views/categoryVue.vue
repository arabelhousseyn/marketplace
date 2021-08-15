<template>
    <div class="main">
            <div class="box">
                <p>Shop by category</p>
             <div class="cats">
                 <div v-for="(sub,index) in subCategory" :key="index" class="category">
                     <router-link to="">{{sub.title_en}}</router-link>
                 </div>
             </div>
            </div>
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
.box{
    padding: 20px;
    background-color: var(--header-background) !important;
    color: var(--text-color);
    border: 1px solid var(--border-bottom);
    border-radius: 10px;
}
.cats{
    display: flex;
    flex-direction: row;
}
.category{
    margin-right: 10px;
    padding: 10px;
    border-radius: 10px;
    background:  var(--trail);
}
.category > a{
    color: unset;
    text-decoration: none;
}

</style>

<script>
import axios from 'axios'
import InfiniteLoading from 'vue-infinite-loading'
import dynamicboxContainer from '../components/dynamicboxContainer.vue'
export default {
    name : 'categoryVue',
    data : ()=>{
        return{
            subCategory : null,
            listingsByCategory :[],
            page : 1,
            id : null,
            path : null,
        }
    },
    components : {
        InfiniteLoading,
        dynamicboxContainer
    },
    mounted(){
        this.path = this.$store.state.imagePath
        let id = this.$route.params.id
       this.fetchData(id)
       this.setId(id)
    },
    methods: {
    fetchData(id) {
        axios.get(`/api/categories/subCategories/${id}`,this.cors())
        .then(e => {
            this.subCategory =  e.data
            console.log(this.subCategory)
        });
    },
    move(value)
        {
            this.$router.push(`/main/product/${value.id}`)
        },
        reload()
        {
            location.reload()
        },
        setId(id){
          this.id = id 
        },
        infiniteHandler($state,id) {
        axios.get(`/api/listingByIdCtegory/${this.id}/?page=${this.page}`,this.cors()).then(({ data }) => {
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
    watch: {
    '$route.params': {
        handler(value) {
            this.fetchData(value.id)
            this.setId(value.id)
        },
        
    }
}
}
</script>
