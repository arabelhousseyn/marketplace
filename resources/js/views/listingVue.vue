<template>
    <section>
    <div class="mainShow">
        <div v-if="listing != null" class="main1">
            <div class="product">
                <div class="row">
                    <div class="col-lg-8">
                        <div v-if="listing.images.length > 0" :style="`background-image: url(${path + listing.images[index].url});`" class="blured">

                        </div>
                       <div v-else class="imagesblured">
                       </div>
                       <div class="displayimages">
                        <router-link to="/"><i class="fa fa-arrow-left icon"></i></router-link>
                        <div class="arrows">
                            <a @click="back" href="#"><i class="fa fa-arrow-left icon"></i></a>
                            <img v-if="listing.images.length > 0" :src="path + listing.images[index].url" :alt="listing.title" height="500" width="500">
                            <img  v-else src="https://via.placeholder.com/500" :alt="listing.title" height="500">
                            <a @click="forward" href="#"><i class="fa fa-arrow-right icon"></i></a>
                        </div>
                       </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="displayinfo">
                            <div class="container data">
                                <h1 id="titlepro">{{listing.title}}</h1>
                                <p><span class="price"><money-format :value="listing.price" locale='fr' currency-code='DZD'></money-format> </span></p>
                                <p><a class="categories" href="#">{{listing.categories.title_en}}</a></p>
                                <p><span class="timelocation">Listed {{listing.created_at}} in {{listing.location.formatted_address}} </span></p>
                                <div v-for="(attribute,index) in listing.attributes" :key="index" class="details">
                                    <p><span class="condition">{{attribute.attribute}}</span></p>
                                    <p><span class="new">{{attribute.value}}</span></p>
                                </div>
                                <div class="descrption">
                                    <p>{{listing.description}}</p>
                                </div>
                                <div class="sellerInfo">
                                    <h5>Seller information</h5>
                                    <p class="contact">
                                        <span>{{listing.user.fname}} {{listing.user.lname}}</span>
                                        <span class="join">Joined marketplace in {{listing.user.created_at.split('-')[0]}}</span>
                                    </p>
                                </div>
                                <div class="maps">
                                    <GmapMap
  :center="{lat:listing.location.lat, lng:listing.location.lng}"
  :zoom="7"
  map-type-id="terrain"
  style="width: 370px; height: 300px"
>
<GmapMarker
    :position="{lat:listing.location.lat, lng:listing.location.lng}"
  />
  </GmapMap>
                                </div>
                            </div>
                            <div class="container">
                                <div class="message">
                                    <p><i class="fa fa-inbox"></i> <span class="txt"> Send message to seller</span> </p>
                                    <form action="" id="sendmessage">
                                        <textarea style="color: white;resize: none;border: 1px solid #2f2f2f;background: #585858;border-radius: 9px;" id="textarea" class="form-control">Send message</textarea>
                                        <button type="submit" class="btn btn-primary form-control send">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
   </section>
</template>
<style>
 .blured{
     position: fixed;
      top: 57px;
      left: 0;
      right: 0;
      z-index: -999;
      filter: blur(50px);
      height: 100%;
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
 }
</style>
<script>
import axios from 'axios'
import MoneyFormat from 'vue-money-format'
export default {
    data : ()=>{
        return{
            listing : null,
            path : null,
            index : 0,
        }
    },
    components : {
        'money-format': MoneyFormat,
    },
    methods : {
        back()
        {
            let length = this.listing.images.length - 1
            if(this.index > 0)
            {
                this.index--
            }else{
               this.index  =  length--
            }
        },
        forward()
        {
            if(this.listing.images.length - 1 == this.index)
            {
                this.index = 0
            }else{
                this.index++
            }
        }
    },
    mounted()
    {
        this.path = this.$store.state.imagePath

        let run = axios.get(`/api/listing/${this.$route.params.id}`,this.cors())
        run.then(e=>{
            this.listing = e.data
        })
        run.catch(e=>{
            if(e.response.status == 404 && e.response.statusText == "Not Found")
            {
                this.$router.push('/')
            }
        })
    }
}
</script>