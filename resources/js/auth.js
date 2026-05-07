import "./bootstrap";
import { createApp } from "vue";
import router from "./src/router/router";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import Auth from "./src/Auth.vue";

const app = createApp(Auth);
app.config.globalProperties.$menu = function (name) {
    this.$router.push({
        name: name,
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
app.use(router);
app.mount("#app");
