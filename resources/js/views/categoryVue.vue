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
export default {
    name : 'categoryVue',
    data : ()=>{
        return{
            subCategory : null,
        }
    },
    mounted(){
        let id = this.$route.params.id
       let run =  axios.get('/api/categories/subCategories/' + id ,this.cors())
        run.then(e=>{
            if(e.status == 200)
            {
               this.subCategory = e.data
            }
        })
    },
    methods: {
    fetchData(id) {
        axios.get('/api/categories/subCategories/' + id ,this.cors())
        .then(e => {
            this.subCategory =  e.data
        });
    }
},
    watch: {
    '$route.params': {
        handler(value) {
            this.fetchData(value.id)
        },
        
    }
}
}
</script>
