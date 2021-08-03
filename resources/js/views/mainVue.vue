<template>
    <div class="m">
        <navbar-vue />
        <div class="mainShow">
        <section>
            <sidebar-vue />
        </section>
        </div>
        <router-view />
    </div>
</template>

<script>
import navbarVue from './navbarVue.vue'
import sidebarVue from './sidebarVue.vue'
export default {
    components : {
        navbarVue,
        sidebarVue
    }
}
</script>