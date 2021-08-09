import Vue from 'vue';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);
export default {
    methods : {
        cors()
        {
            let headers = {
                Authorization : "Bearer 1|eEi7hwzDZPvD4LAvCeTTFRlMbGGcep2Dv8JomWXg",
                'Content-Type': 'application/json',
            }
            return {headers}
        },
        statu(msg,type)
        {
            return Vue.$toast.open({
                message: msg,
                type: type,
            });
        }
    }
    
}


