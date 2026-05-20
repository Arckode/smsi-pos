import { createRouter, createWebHistory } from "vue-router";

//public
// import Scanner from "../App.vue";
//public
import Home from "../view/homepage/Index.vue";
import About from "../view/homepage/about.vue";
import Activity from "../view/homepage/activity.vue";
import Contact from "../view/homepage/contacts.vue";

//auth
// const Login = () => import("../view/auth/Index.vue");
const Login = () => import("../Auth.vue");

//admin
import AdminIndex from "../view/admin/Index.vue";
import A_UserListsIndex from "../view/admin/users/userlist/Index.vue";
import A_UserAccessIndex from "../view/admin/users/useraccess/Index.vue";
import A_AffiliasiIndex from "../view/admin/management/affiliasi/Index.vue";
// import A_BooksIndex from "../view/admin/book/Index.vue";

import A_NasabahListIndex from "../view/admin/nasabah/list/Index.vue";
import A_PinjamanListIndex from "../view/admin/angsuran/pinjaman/list/Index.vue";
import A_PembayaranListIndex from "../view/admin/angsuran/pembayaran/list/Index.vue";
import A_NeracaIndex from "../view/admin/neraca/Index.vue";
import A_PenghasilanIndex from "../view/admin/penghasilan/Index.vue";
import A_InputIndex from "../view/admin/input/Index.vue";
import A_ImportIndex from "../view/admin/importdata/Index.vue";

import A_DocumentListIndex from "../view/admin/document/list/Index.vue";
import A_DocumentShipmentIndex from "../view/admin/document/shipment/Index.vue";
import A_ProfileIndex from "../view/admin/profile/Profile.vue";
import A_UsersIndex from "../view/admin/profile/Users.vue";

const router = createRouter({
    history: createWebHistory("/"),
    routes: [
        //public
        // {
        //     path: "/",
        //     name: "scanner",
        //     component: Scanner,
        // },
        //public
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/about",
            name: "about",
            component: About,
        },
        {
            path: "/activity",
            name: "activity",
            component: Activity,
        },
        {
            path: "/contact",
            name: "contact",
            component: Contact,
        },

        //auth
        {
            path: "/login:token?",
            name: "login",
            component: Login,
            meta: {
                reloadOnNavigation: true,
            },
        },

        //admin
        {
            path: "/dashboard",
            name: "admin.dashboard",
            component: AdminIndex,
            meta: {
                breadcrumb: "Dashboard"
            },
        },
        //-----------------------------------------------------------------------------------------------------------------------------------
        //SMSi POS Start
        //-----------------------------------------------------------------------------------------------------------------------------------
        {
            path: "/users",
            name: "admin.userlists",
            component: A_UserListsIndex,
            meta: {
                breadcrumb: "User List Management"
            },
        },
        {
            path: "/management/affiliasi",
            name: "admin.affiliasi",
            component: A_AffiliasiIndex,
            meta: {
                breadcrumb: "Affiliasi Management"
            },
        },
        {
            path: "/users/access",
            name: "admin.useraccess",
            component: A_UserAccessIndex,
            meta: {
                breadcrumb: "User Access Management"
            },
        },
        {
            path: "/nasabah/lists",
            name: "admin.nasabahlist",
            component: A_NasabahListIndex,
            meta: {
                breadcrumb: "Nasabah",
            },
        },
        //-----------------------------------------------------------------------------------------------------------------------------------
        //SMSi POS End
        //-----------------------------------------------------------------------------------------------------------------------------------
        {
            path: "/user/document/list",
            name: "admin.documentlist",
            component: A_DocumentListIndex,
            meta: {
                breadcrumb: "Document List",
            },
        },
        {
            path: "/admin/document/shipment",
            name: "admin.documentshipment",
            component: A_DocumentShipmentIndex,
            meta: {
                breadcrumb: "Document Batch",
            },
        },
        {
            path: "/user/profile",
            name: "admin.profile",
            component: A_ProfileIndex,
            meta: {
                breadcrumb: "Profile",
            },
        },
        {
            path: "/admin/users",
            name: "admin.users",
            component: A_UsersIndex,
            meta: {
                breadcrumb: "User Lists",
            },
        },
        
        {
            path: "/angsuran/pinjaman/list",
            name: "admin.pinjamanlist",
            component: A_PinjamanListIndex,
            meta: {
                breadcrumb: "Angsuran Pinjaman",
            },
        },
        {
            path: "/angsuran/tunggakan/list",
            name: "admin.pembayaranlist",
            component: A_PembayaranListIndex,
            meta: {
                breadcrumb: "Tunggakan",
            },
        },
        {
            path: "/input",
            name: "admin.input",
            component: A_InputIndex,
            meta: {
                breadcrumb: "Menu Inputan",
            },
        },
        {
            path: "/import",
            name: "admin.import",
            component: A_ImportIndex,
            meta: {
                breadcrumb: "Import Data",
            },
        },
        {
            path: "/report/neraca",
            name: "admin.neraca",
            component: A_NeracaIndex,
            meta: {
                breadcrumb: "Neraca Transisi",
            },
        },
        {
            path: "/report/penghasilan",
            name: "admin.penghasilan",
            component: A_PenghasilanIndex,
            meta: {
                breadcrumb: "Report Hasil Usaha",
            },
        },
    ],
});

router.beforeEach((to, from, next) => {
    const publicPages = ["/login", "/"];
    const authRequired = !publicPages.includes(to.path);
    const loggedIn = localStorage.getItem("user");

    if (to.path === "/login/:token" && !loggedIn && to.params.token) {
        next({
            name: "login",
            params: {
                token: to.params.token,
            },
        });
    } else if (authRequired && !loggedIn && !to.params.token) {
        next("/login");
    } else {
        next();
    }
});

export default router;
