<template>
    <div class="a23">
        <div style="text-align:center;" v-if="data == undefined">
            <spinner-loading />
        </div>
        <div v-else>
           <div v-if="data.listings_count <= 0">
               <div style="text-align:center; transform: translate(0px, 252px);" class="message">
                   <i class="fa fa-inbox fa-5x"></i>
                   <h3>User does'nt have any listings.</h3>
               </div>
           </div>
           <div v-else>
               <div class="container">
                   <div class="row">
                       <div class="col-lg-8">
                           <div class="box content" style="top:0px;">
                               <div class="heading">
                                   <h4>listings</h4>
                               </div>
                            </div>
                        <div class="sizedBox" style="margin-top:20px;"></div>
                           <div style="margin-top:20px;" v-for="(listing,index) in data.listings" :key="index" class="box">
                               <div @click="move(listing)" style="cursor:pointer;" class="information container">
                                   <div class="row">
                                       <div class="col-lg-2">
                                           <img style="width:100px;height:100px;" v-if="listing.images.length > 0" :src="listing.images[0]" alt="image">
                                           <img v-else src="https://via.placeholder.com/100" alt="image">
                                       </div>
                                       <div class="col-lg-8">
                                           <div class="attributes">
                                       <div class="title">{{listing.title}}</div>
                                       <div class="price"><money-format :value="listing.price" locale="fr" currency-code="DZD"></money-format></div>
                                       <div class="creation">{{listing.creation}}</div>
                                       <div class="location">{{listing.location.formatted_address}}</div>
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
        <addlisting-modal />
    </div>
</template>

<script>
import spinnerLoading from './spinnerLoading.vue'
import addlistingModal from '../modals/addListingModal.vue'
import MoneyFormat from "vue-money-format"
export default {
    props : ['data'],
    components : {
        spinnerLoading,
        addlistingModal,
        "money-format": MoneyFormat,
    },
    methods : {
        move(listing)
        {
            this.$emit('move',listing)
        }
    }
}
</script>