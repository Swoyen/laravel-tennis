require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";

import App from "./components/App.vue";

Vue.use(VueRouter);

import { ObserveVisibility } from "vue-observe-visibility";
Vue.directive("observe-visiblity", ObserveVisibility);

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
Vue.use(VueSweetalert2);

const app = new Vue({
    el: "#app",
    components: {
        App
    },
    router: new VueRouter(routes)
});
