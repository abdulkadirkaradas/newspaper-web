import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "../components/dashboard/dashboard.vue";
import LoginPage from "../components/auth/login/login.vue";
import RegisterPage from "../components/auth/register/register.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Dashboard,
        meta: { showRouterView: false, showNewsFlow: true },
    },
    {
        path: "/login",
        name: "login.view",
        component: LoginPage,
        meta: { showRouterView: true },
    },
    {
        path: "/register",
        name: "register.view",
        component: RegisterPage,
        meta: { showRouterView: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
