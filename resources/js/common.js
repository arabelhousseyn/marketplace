import Vue from 'vue';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);
export default {
    methods : {
        cors()
        {
            let headers = {
                Authorization : "Bearer 1|qkrNjhm7R0l8FlRbl48KLLPH6Ypj6TBNwrQVaHy5",
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


