<template>
    <div class="a23">
        <div style="text-align:center;" v-if="data == undefined">
            <spinner-loading />
        </div>
        <div v-else>
           <div v-if="data.listings_count <= 0">
               <div style="text-align:center; transform: translate(0px, 252px);" class="message">
                   <i class="fa fa-inbox fa-5x"></i>
                   <h3>When you start selling, your listings will appear here.</h3>
                   <div class="container"><a class="inf1" href='#' data-toggle="modal" data-target="#addListing"><div class="info1"><i class="fa fa-plus"></i> <span>Create New Listing</span></div></a></div>
               </div>
           </div>
           <div v-else>
               <div class="container">
                   <div class="row">
                       <div class="col-lg-8">
                           <div class="box content" style="top:0px;">
                               <div class="heading">
                                   <h4>Your listings</h4>
                               </div>
                               <div class="search">
                                  <div class="boxSearch">
                                    <label for="search"><i class="fa fa-search"></i></label>
                                      <input type="text" placeholder="Search your listings" id="search">
                                       </div>
                                         </div>
                            </div>
                        <div class="sizedBox" style="margin-top:20px;"></div>
                           <div style="margin-top:20px;" v-for="(listing,index) in data.listings" :key="index" class="box">
                               <div style="cursor:pointer;" class="information container">
                                   <div class="row">
                                       <div @click="move(listing)" class="col-lg-2">
                                           <img style="width:100px;height:100px;" v-if="listing.images.length > 0" :src="listing.images[0]" alt="image">
                                           <img v-else src="https://via.placeholder.com/100" alt="image">
                                       </div>
                                       <div class="col-lg-8">
                                           <div class="attributes">
                                       <div class="title">{{listing.title}}</div>
                                       <div class="price"><money-format :value="listing.price" locale="fr" currency-code="DZD"></money-format></div>
                                       <div class="creation">{{listing.creation}}</div>
                                       <div class="location">{{listing.location.formatted_address}}</div>
                                       <div class="actions">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <a class="inf1" href='#' @click="getSignleListing(listing)" data-toggle="modal" data-target="#editListing"><div class="info1"><i class="fa fa-pen"></i> <span>Edit listing</span></div></a>
                                            </div>
                                            <div class="col-lg-6">
                                                <a class="inf1" @click="getSignleListing(listing)" href='#' data-toggle="modal" data-target="#delListing"><div style='background: #3a3b3c;color: white;' class="info1"><i class="fa fa-minus"></i> <span>Delete listing</span></div></a>
                                            </div>
                                        </div>
                                       </div>
                                   </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                        <div class="col-lg-4">
                           <div class="box">
                               <div class="heading">
                                   <div class="titles">
                                       <h6>Your Commerce Profile</h6>
                                        <h5 style="font-size:18px;">{{data.fname}} {{data.lname}}</h5>
                                        <span style="font-size:12px;color:#dadada;">{{data.listings_count}} Active listings</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        </div>
        <removelisting-modal @removed='removed' v-if="listing != null" :listing="listing" />
        <updatelisting-modal v-if="listing != null" :listing="listing" />
    </div>
</template>

<script>
import spinnerLoading from './spinnerLoading.vue'
import MoneyFormat from "vue-money-format"
import removelistingModal from '../modals/removelistingModal.vue'
import updatelistingModal from '../modals/updatelistingModal.vue'
export default {
    props : ['data'],
    data : ()=>{
        return{
            listing : null,
        }
    },
    components : {
        spinnerLoading,
        "money-format": MoneyFormat,
        removelistingModal,
        updatelistingModal
    },
    methods : {
        move(listing)
        {
            this.$emit('move',listing)
        },
        getSignleListing(listing)
        {
            this.listing = listing
        },
        removed(listingGetter)
        {
           this.data.listings =  this.data.listings.filter(e => e.id != listingGetter.id)
        }
    }
}
</script>