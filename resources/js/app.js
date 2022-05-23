require("./bootstrap");

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import vueDebounce from 'vue-debounce'
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js/auto'
import "./index.css"
import "../js/Components/Tooltip/Styles/main.css";
import directives from "../js/Components/Tooltip/Directives/index";
import Notifications from 'notiwind';
import AppLayout from "./Layouts/AppLayout";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";


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
.use(Notifications)
.component('QuillEditor', QuillEditor)
.component('vueDebounce', vueDebounce)
.component('Datepicker', Datepicker)
.mount(el);

InertiaProgress.init({ color: "#4B5563" });
