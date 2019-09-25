import axios from 'axios';
import Vue from 'vue';
import router from './routes'
import VueRouter from 'vue-router';
window.axios = axios;
window.vue = Vue;
Vue.use(VueRouter);
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

new Vue({
   el:'#app',
    data:{
       name:"",
    },
    router:router
});
