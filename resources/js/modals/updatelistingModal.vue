<template>
    <div style='color: #313131;' class="modal fade" id="editListing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update listing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div v-if="errors.length > 0" class="alert alert-danger">
          <ul>
              <li v-for="(error,index) in errors" :key="index">{{error}}</li>
          </ul>
      </div>
       <form @submit.prevent="update" method="post">
            <div class="form-group">
            <label for="title" class="bold">Title</label>
            <input type="text" v-model="listing.title" id="title" class="form-control input" placeholder="Title" required>
            </div>

             <div class="form-group">
            <label for="price" class="bold">Price</label>
            <input type="text" v-model="listing.price" id="price" class="form-control input" placeholder="Price" required>
            </div>

            <div class="form-group">
            <label for="description" class="bold">Description</label>
            <textarea id="description" v-model="listing.description" class="form-control" required/>
            </div>

            <div class="form-group">
            <label for="category" class="bold">Category</label>
            <select v-model="listing.categories.id" class="form-control" id="category">
                <option v-for="(category,index) in categories" :key="index" :value="category.id">
                    {{category.title_en}}
                </option>
            </select>
            </div>

            <input type="submit" value="Update" class="btn btn-success form-control">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios'
export default {
    props : ['listing'],
    data : ()=>{
        return{
            categories : null,
            errors : [],
            formatedListing : {
                title : null,
                description : null,
                price : null,
                location : null,
                category_id : null
            }
        }
    },
    methods : {
        update()
        {
           this.formatedListing.title = this.listing.title
           this.formatedListing.description = this.listing.description
           this.formatedListing.price = this.listing.price,
           this.formatedListing.location = `${this.listing.location.lat},${this.listing.location.lng}`
           this.formatedListing.category_id = this.listing.categories.id

            let run = axios.put(`/api/listing/${this.listing.id}`,this.formatedListing,this.cors())
            run.then(e=>{
               if(e.status == 204)
               {
                   this.statu('updated','success')
                   setTimeout(() => {
                       location.reload()
                   }, 1000);
               }
            })
            run.catch(e=>{
                let errors = e.response.data.errors
                for (const [key, value] of Object.entries(errors)) {
                    this.errors.push(value[0])
                    this.disabled = false
              }
            })
        }
    },
    created()
    {
        this.categories = this.$store.state.categories
    }
}
</script>