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
    require('./views/home').default
);
Vue.component(
    'navbar',
    require('./views/navbar').default
);
Vue.component(
    'about',
    require('./views/about').default
);
Vue.component(
    'newsplit',
    require('./views/NewSplit').default
);
Vue.component(
    'formerror',
    require('./components/FormErrorResponse').default
);
Vue.component(
    'splitdetails',
    require('./views/AddExpense/splitDetails').default
);
Vue.component(
    'view-expense',
    require('./views/viewExpenses').default
);
Vue.component(
    'split-differently',
    require('./views/AddExpense/splitDifferently').default
)
new Vue({
   el:'#app',
    data:{
       name:"",
    },
    router:new VueRouter(routes),
}).$mount('#app');
