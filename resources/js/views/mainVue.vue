<template>
    <div class="m">
        <navbar-vue />
        <div class="mainShow">
        <section>
            <sidebar-vue />
        </section>
        </div>
        <router-view />
        <addlisting-modal v-if="auth !== ''" />
    </div>
</template>

<script>
import navbarVue from './navbarVue.vue'
import sidebarVue from './sidebarVue.vue'
import addlistingModal from '../modals/addListingModal.vue'
export default {
    props : ['auth'],
    components : {
        navbarVue,
        sidebarVue,
        addlistingModal
    },
    methods : {
        position(pos)
         {
            this.$store.state.location = `${pos.coords.latitude},${pos.coords.longitude}`
         }
    },
    created()
    {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(this.position)
            }

        this.$store.state.auth = (this.auth !== '') ? JSON.parse(this.auth) : ''
    }
}
</script>