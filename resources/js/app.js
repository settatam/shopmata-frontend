require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import vueDebounce from 'vue-debounce'
import "./index.css"
import "../js/Components/Tooltip/Styles/main.css";
import directives from "../js/Components/Tooltip/Directives/index";

import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from '@fortawesome/free-solid-svg-icons'
library.add(fas);
import { fab } from '@fortawesome/free-brands-svg-icons';
library.add(fab);
import { far } from '@fortawesome/free-regular-svg-icons';
library.add(far);
import { dom } from "@fortawesome/fontawesome-svg-core";
dom.watch();

const el = document.getElementById('app');
// register all directives
const test = createApp(InertiaApp);
directives(test);


createApp({
    render: () =>
    h(InertiaApp, {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: (name) => require(`./Pages/${name}`).default,
    }),
})
<<<<<<< HEAD
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .component('QuillEditor', QuillEditor)
    .component('vueDebounce', vueDebounce)
    .component("font-awesome-icon", FontAwesomeIcon)
    .mount(el);
=======
.mixin({ methods: { route } })
.use(InertiaPlugin)
.component('QuillEditor', QuillEditor)
.component('vueDebounce', vueDebounce)
.mount(el);

>>>>>>> 6090e2436368f456484638dae58e2e6bf1b511bd

InertiaProgress.init({ color: '#4B5563' });
