<template>
    <div class="box">
                <div class="heading">
                    <h1 class="title">Today's pick</h1>
                    <a href="">60 km</a>
                </div>
                <div class="divider"></div>
                <div v-if="listings.length > 0" class="row">
                    <div v-for="(listing,index) in listings" :key="index" class="col-lg-3">
                        <div @click="move(listing)" class="listing">
                            <div v-if="listing.images.length > 0">
                                <img class="image" :src="path + listing.images[0].url" :alt="listing.name_en">
                            </div>
                            <div v-else>
                                <img class="image" src="http://via.placeholder.com/226" alt="images">
                            </div>
                            <span class="title">{{listing.title}}</span>
                            <span class="price">
                                <money-format :value="listing.price" locale='fr' currency-code='DZD'></money-format>
                            </span>
                           <!-- <span class="location" >{{listing.location.formatted_address}}</span> -->
                        </div>
                    </div>
                </div>
                <div v-else class="spin">
                    <spinner-loading />
                </div>
                <div class="line"></div>
            </div>
</template>

<script>
import spinnerLoading from './spinnerLoading.vue'
import MoneyFormat from 'vue-money-format'
export default {
    props : ['listings','path'],
    components : {
        'money-format': MoneyFormat,
        spinnerLoading
    },
    methods : {
        move(listing)
        {
            this.$emit('move',listing)
        }
    }
}
</script>