import VueRouter from'vue-router';


let routes = [
    {
        path: '/',
        component:'./views/home'
    }
]
export default new VueRouter({

    routes: routes,
})
