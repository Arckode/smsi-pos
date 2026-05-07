import "./bootstrap";
import $ from "jquery";
window.$ = window.jQuery = $;
import "datatables.net-bs5";
import "datatables.net-bs5/css/dataTables.bootstrap5.min.css";
import { createApp } from "vue";
import router from "./src/router/router";
import App from "./src/App.vue";

const app = createApp(App);
app.config.globalProperties.$menu = function (name) {
    this.$router.push({
        name: name,
    });
};
app.use(router);
app.mount("#app");
