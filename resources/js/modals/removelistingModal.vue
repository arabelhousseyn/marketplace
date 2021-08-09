<template>
    <div style='color: #313131;' class="modal fade" id="delListing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete listing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <p> If you want to delete a listing <span class="badge badge-danger">Delete</span> else click <span class="badge badge-secondary">Close</span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" @click="remove" data-dismiss='modal' class="btn btn-danger"><i class="fa fa-minus"></i> Delete</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios'
export default {
  props : ['listing'],
  methods : {
    remove()
    {
      let run  = axios.delete(`/api/listing/${this.listing.id}/`,this.cors())
      run.then(e=>{
        if(e.status == 200)
        {
          this.$emit('removed',this.listing)
        }
      })
    }
  }
}
</script>