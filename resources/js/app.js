require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";

import App from "./components/App.vue";

Vue.use(VueRouter);

import { ObserveVisibility } from "vue-observe-visibility";
Vue.directive("observe-visiblity", ObserveVisibility);

const app = new Vue({
    el: "#app",
    components: {
        App
    },
    router: new VueRouter(routes)
});
