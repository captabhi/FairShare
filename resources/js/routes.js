import home from './views/home'
import about from "./views/about";
import splitDetails from "./views/AddExpense/splitDetails";
export default {
    mode:'history',
    routes:[
        {
            path: '/',
            component:home,
         },
        {
            path: '/about',
            component:about,
        },

    ]
}
