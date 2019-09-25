import axios from 'axios';
import Vue from 'vue';
import routes from './routes'
import VueRouter from 'vue-router';
window.axios = axios;
window.vue = Vue;
Vue.use(VueRouter);
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.component(
    'home',
    require('./views/home')
);
Vue.component(
    'navbar',
    require('./views/navbar').default
);
Vue.component(
    'about',
    require('./views/about').default
);

new Vue({
   el:'#app',
    data:{
       name:"",
    },
    router:new VueRouter(routes),
}).$mount('#app');
