import "./bootstrap";
import $ from "jquery";
window.$ = window.jQuery = $;
// import "datatables.net-bs5";
// import "datatables.net-bs5/css/dataTables.bootstrap5.min.css";
import "select2/dist/js/select2.full.min.js";
import "select2/dist/css/select2.min.css";
import "select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css";
import { createApp } from "vue";
import router from "./src/router/router";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import Admin from "./src/Admin.vue";

const app = createApp(Admin);

console.log("Admin.js loaded successfully.", app.config.globalProperties.$menu);
app.config.globalProperties.$menu = function (name) {
    this.$router.push({
        path: name,
    });
};
app.config.globalProperties.$token = function () {
    try {
        const token = localStorage.getItem("user");
        if (token) {
            return JSON.parse(token);
        } else {
            return null;
        }
    } catch (error) {
        console.error("Error retrieving default profile: ", error);
        return null;
    }
};

app.use(VueSweetalert2);
app.component('VueDatePicker', VueDatePicker);
app.use(router);

if ("serviceWorker" in navigator) {
    window.addEventListener("load", function() {
        navigator.serviceWorker.register("/serviceworker.js")
            .then(function(registration) {
                console.log("ServiceWorker registration successful with scope: ", registration.scope);
            })
            .catch(function(err) {
                console.error("ServiceWorker registration failed: ", err);
            });
    });
}

app.mount("#app");
