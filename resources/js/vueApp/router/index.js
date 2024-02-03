import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from "@/views/Dashboard.vue"
import Login from "@/views/Login.vue"
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
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
    ]
})
export default router;


router.beforeEach(async(to) => {
    const authRequired = to.meta.authRequired;
    if (!localStorage.getItem("isAuth") && authRequired == true) {
        return '/login';
    }
});



