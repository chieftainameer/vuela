import Vue from "vue";
import VueRouter from "vue-router";
import LoginComponent from "./components/LoginComponent";
import AdminComponent from "./components/AdminComponent";
import NavComponent from "./components/NavComponent";
import ToolComponent from "./components/ToolComponent";
import RolesComponent from "./components/RolesComponent";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        redirect: "/login"
    },
    {
        path: "/login",
        component: LoginComponent,
        name: "Login",
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem("token")) {
                next("/admin");
            } else {
                next();
            }
        }
    },
    {
        path: "/admin",
        component: AdminComponent,
        children: [
            {
                path: "roles",
                component: RolesComponent
            }
        ],
        name: "Admin",
        beforeEnter: (to, from, next) => {
            if (localStorage.getItem("token")) {
                next();
            } else {
                next("/login");
            }
        }
    },
    {
        path: "/nav",
        component: NavComponent
    },
    {
        path: "/tool",
        component: ToolComponent
    }
];
export default new VueRouter({ routes });
