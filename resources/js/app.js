require("./bootstrap");

// Import modules...
import { createApp, h } from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import vueDebounce from "vue-debounce";
import Chartkick from "vue-chartkick";
import "chartkick/chart.js";
import Vue from "vue";
import Chart from "chart.js/auto";
import "./index.css";
import "../js/Components/Tooltip/Styles/main.css";
import directives from "../js/Components/Tooltip/Directives/index";

const el = document.getElementById("app");
// register all directives
const test = createApp(InertiaApp);
directives(test);

// Vue.use(Chartkick.use(Chart));

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .use(Chartkick.use(Chart))
    .component("QuillEditor", QuillEditor)
    .component("vueDebounce", vueDebounce)
    .mount(el);

InertiaProgress.init({ color: "#4B5563" });
