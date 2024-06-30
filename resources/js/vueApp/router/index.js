import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from "@/views/Dashboard.vue"
import SignUp from "@/views/SignUp.vue"
import Index from "@/views/Index.vue"
import Login from "@/views/Login.vue"
import DiseaseSearch from "@/views/DiseaseSearch.vue"
import UserManagement from "@/views/UserManagement.vue"
const router = createRouter({
    history: createWebHistory('/'),
    routes: [
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                authRequired: true
            }
          },
        {
            path: "/login",
            name: "login",
            component: Login,
        },
        {
            path: "/signup",
            name: "signup",
            component: SignUp,
            meta: {
                authRequired: 'both'
            }

        },
         {
            path: "/users",
            name: "UserManagement",
            component: UserManagement,
            meta: {
                authRequired: true
            }
        }, {
            path: "/",
            name: "Index",
            component: Index,
           
        }, {
            path: "/disease-search",
            name: "DiseaseSearch",
            component: DiseaseSearch,
           
        },
    ]
})
export default router;


router.beforeEach(async(to) => {
    const authRequired = to.meta.authRequired;
    if (!localStorage.getItem("isAuth") && authRequired == true) {
        return '/login';
    }
    if (localStorage.getItem("isAuth") && (authRequired != true && authRequired != 'both') ){
        return '/dashboard';
    }

});



