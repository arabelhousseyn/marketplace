<template>
    <div style='color: #313131;' class="modal fade" id="addListing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add listing</h5>
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
        <form @submit.prevent="add" method="post">
            <div class="form-group">
            <label for="title" class="bold">Title</label>
            <input @keypress="checker" type="text" v-model="formData.title" id="title" class="form-control input" placeholder="Title" required>
            </div>

             <div class="form-group">
            <label for="price" class="bold">Price</label>
            <input @keypress="checker" type="text" v-model="formData.price" id="price" class="form-control input" placeholder="Price" required>
            </div>

            <div class="form-group">
            <label for="description" class="bold">Description</label>
            <textarea id="description" @keypress="checker" v-model="formData.description" class="form-control" required/>
            </div>

            <div class="form-group">
            <label for="category" class="bold">Category</label>
            <select @change="checker" v-model="formData.category_id" class="form-control" id="category">
                <option v-for="(category,index) in categories" :key="index" :value="category.id">
                    {{category.title_en}}
                </option>
            </select>
            </div>

            <div class="form-group">
                <div class="custom-file">
    <input @change="formatImage" accept=".jpg,.png,.jpeg,.gif" type="file" class="custom-file-input" id="images" multiple>
    <label class="custom-file-label" for="images">Choose Images...</label>
    </div>
            </div>
            <img class="boxImage" v-for="(display,index) in displays" :key="index" :src="display" alt="image">
            <input type="submit" value="Add" :disabled="disabled" class="btn btn-primary form-control">
        </form>
      </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
</template>

<style>
  .modal-backdrop{
      position: unset !important;
  }
  .input{
      border: 1px solid var(--border-bottom) !important;
      color: black !important;
  }
  .boxImage{
    width: 150px;
    height: 150px;
    border: 1px solid grey;
    margin: 3px 0 20px 3px;
  }
</style>

<script>
import axios from 'axios'
export default {
    data : ()=>{
        return{
            disabled : true,
            categories : null,
            formData : {
                title : null,
                price : null,
                description : null,
                category_id : null,
                location : '0,0',
                attributes : [
                    {
                        attribute : 'color',
                        value : 'black'
                    }
                ],
                images : [],
            },
            displays : [],
            errors : []
        }
    },
    methods : {
        add()
        {
            this.disabled = true
            let data = new FormData()
            data.append('title',this.formData.title)
            data.append('price',this.formData.price)
            data.append('description',this.formData.description)
            data.append('category_id',this.formData.category_id)
            data.append('location',this.formData.location)
            data.append('attributess',JSON.stringify(this.formData.attributes))
            for (let i = 0; i < this.formData.images.length; i++) {
                let img = this.formData.images[i]
                data.append('images' + i,img)                 
            }
            data.append('numberImages',this.formData.images.length)

            let run = axios.post('/api/listing',data,this.cors())
            run.then(e=>{
                if(e.status == 201)
                {
                    location.reload()
                }
            })
            run.catch(e=>{
                let errors = e.response.data.errors
                for (const [key, value] of Object.entries(errors)) {
                    this.errors.push(value[0])
                    this.disabled = false
              }
            })
        },
        checker()
        {
            this.disabled = (this.formData.title == null || this.formData.price == null || 
            this.formData.description == null || this.formData.category_id == null) ? true : false
        },
        formatImage(e)
        {
            let files = e.target.files
            let read;
            let i = 0;

            for (i = 0; i < files.length; i++) {
                this.formData.images.push(files[i])
                read = new FileReader()
                  read.onload = (f)=>{
                     this.displays.push(f.target.result)
                  }
                  read.readAsDataURL(files[i])   
            }
        }
    },
    mounted()
    {
        this.formData.location = this.$store.state.location
        this.categories = this.$store.state.categories
    }
}
</script>