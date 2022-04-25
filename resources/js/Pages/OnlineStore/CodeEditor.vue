<template>
    <!-- FONT AWESOME LINK -->
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous"
    />
    <!-- FONT AWESOME LINK -->

    <app-layout id="top" :navigation="navigation">
        <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
            <!-- Breadcrumb -->

            <div class="flex-1 flex xl:overflow-hidden ml-5">
                <!-- Secondary sidebar -->
                <nav
                    aria-label="Sections"
                    class="
                        hidden
                        flex-shrink-0
                        w-96
                        bg-white
                        border-r border-blue-gray-200
                        xl:flex xl:flex-col
                        mt-12
                    "
                >
                    <!-- Probably still gonna remove this -->
                    <div
                        class="
                            flex-shrink-0
                            h-16
                            px-6
                            border-b border-blue-gray-200
                            flex
                            items-center
                        "
                    >
                        <p class="text-lg font-medium text-gray-900">
                            Code Editor
                        </p>
                    </div>
                    <!-- Template  -->
                    <div>
                        <div
                            @click="toggleTemplate"
                            class="
                                flex
                                min-h-0
                                overflow-y-auto
                                px-6
                                pt-9
                                justify-between
                                cursor-pointer
                            "
                        >
                            <div class="flex">
                                <img
                                    src="../../../assets/icons/download_icon.svg"
                                    alt="download-icon"
                                />
                                <p class="ml-4.5 font-bold text-xl">
                                    Templates
                                </p>
                            </div>
                            <span class="ml-3" v-if="displayTemplate"
                                ><i class="fas fa-chevron-up my-auto"></i
                            ></span>
                            <span class="ml-3" v-else
                                ><i class="fas fa-chevron-down my-auto"></i
                            ></span>
                        </div>
                        <ul class="px-6 mb-3" v-if="displayTemplate">
                            <div
                                class="
                                    flex
                                    justify-between
                                    cursor-pointer
                                    text-cyan-700
                                "
                                @click="popTemplate"
                            >
                                <p class="font-semibold text-lg">
                                    Add a new Template
                                </p>
                                <i class="far fa-plus-square mx-0 my-auto"></i>
                            </div>
                            <div v-for="file in all_files" :key="file.id">
                                <li
                                    class="text-lg pt-4 cursor-pointer"
                                    @click="getContent(file)"
                                >
                                    { } {{ file.title }}
                                </li>
                            </div>
                        </ul>
                    </div>
                    <!-- Layout -->
                    <div>
                        <div
                            @click="toggleLayout"
                            class="
                                flex
                                min-h-0
                                overflow-y-auto
                                px-6
                                pt-9
                                justify-between
                                cursor-pointer
                            "
                        >
                            <div class="flex">
                                <img
                                    src="../../../assets/icons/download_icon.svg"
                                    alt="download-icon"
                                />
                                <h3 class="ml-4.5 font-bold text-xl">
                                    Layouts
                                </h3>
                            </div>
                            <span class="ml-3" v-if="displayLayout"
                                ><i class="fas fa-chevron-up"></i
                            ></span>
                            <span class="ml-3" v-else
                                ><i class="fas fa-chevron-down"></i
                            ></span>
                        </div>
                        <ul class="px-6 mb-3" v-if="displayLayout">
                            <div
                                class="
                                    flex
                                    justify-between
                                    text-cyan-700
                                    cursor-pointer
                                "
                                @click="popLayout"
                            >
                                <p class="font-semibold text-lg">
                                    Add a new Layout
                                </p>
                                <i class="far fa-plus-square mx-0 my-auto"></i>
                            </div>
                            <div v-for="file in all_files" :key="file.id">
                                <li
                                    class="text-lg pt-4 cursor-pointer"
                                    @click="getContent(file)"
                                >
                                    { } {{ file.title }}
                                </li>
                            </div>
                        </ul>
                    </div>
                    <!-- Assets -->
                    <!-- <div> -->
                    <div
                        @click="toggleAsset"
                        class="
                            flex
                            min-h-0
                            overflow-y-auto
                            px-6
                            pt-9
                            justify-between
                            cursor-pointer
                        "
                    >
                        <div class="flex">
                            <img
                                src="../../../assets/icons/download_icon.svg"
                                alt="download-icon"
                            />
                            <h3 class="ml-4.5 font-bold text-xl">Assets</h3>
                        </div>
                        <span class="ml-3" v-if="displayAsset"
                            ><i class="fas fa-chevron-up"></i
                        ></span>
                        <span class="ml-3" v-else
                            ><i class="fas fa-chevron-down"></i
                        ></span>
                    </div>
                    <ul class="px-6 mb-3" v-if="displayAsset">
                        <div
                            class="
                                flex
                                justify-between
                                pt-4
                                text-cyan-700
                                cursor-pointer
                            "
                            @click="popAsset"
                        >
                            <p class="font-semibold text-lg">Add a new Asset</p>
                            <i class="far fa-plus-square mx-0 my-auto"></i>
                        </div>
                        <div v-for="file in all_files" :key="file.id">
                            <li
                                class="text-lg pt-4 cursor-pointer"
                                @click="getContent(file)"
                            >
                                <!-- Probably still gonna remove this -->
                                <div
                                    class="
                                        flex-shrink-0
                                        h-16
                                        px-6
                                        border-b border-blue-gray-200
                                        flex
                                        items-center
                                    "
                                >
                                    <p
                                        class="
                                            text-lg
                                            font-medium
                                            text-blue-gray-900
                                        "
                                    >
                                        Code Editor
                                    </p>
                                </div>
                            </li>
                        </div>

                        <!-- Template  -->
                        <div>
                            <div
                                @click="toggleTemplate"
                                class="
                                    flex
                                    min-h-0
                                    overflow-y-auto
                                    px-6
                                    pt-9
                                    justify-between
                                    cursor-pointer
                                "
                            >
                                <div class="flex">
                                    <img
                                        src="../../../assets/icons/download_icon.svg"
                                        alt="download-icon"
                                    />
                                    <p class="ml-4.5 font-bold text-xl">
                                        Templates
                                    </p>
                                </div>
                                <span
                                    class="ml-3 my-auto"
                                    v-if="displayTemplate"
                                    ><ChevronUpIcon class="h-4 text-black"
                                /></span>
                                <span class="ml-3 my-auto" v-else
                                    ><ChevronDownIcon class="h-4 text-black"
                                /></span>
                            </div>
                            <ul class="px-6 mb-3" v-if="displayTemplate">
                                <div
                                    class="
                                        flex
                                        justify-between
                                        cursor-pointer
                                        text-cyan-700
                                    "
                                    @click="popTemplate"
                                >
                                    <p class="font-semibold text-lg">
                                        Add a new Template
                                    </p>
                                    <i
                                        class="far fa-plus-square mx-0 my-auto"
                                    ></i>
                                </div>
                                <div
                                    v-for="file in theme_files[1]"
                                    :key="file.id"
                                >
                                    <li
                                        class="text-lg pt-4 cursor-pointer"
                                        @click="getContent(file)"
                                    >
                                        { } {{ file.title }}
                                    </li>
                                </div>
                            </ul>
                        </div>
                        <!-- Layout -->
                        <div>
                            <div
                                @click="toggleLayout"
                                class="
                                    flex
                                    min-h-0
                                    overflow-y-auto
                                    px-6
                                    pt-9
                                    justify-between
                                    cursor-pointer
                                "
                            >
                                <div class="flex">
                                    <img
                                        src="../../../assets/icons/download_icon.svg"
                                        alt="download-icon"
                                    />
                                    <h3 class="ml-4.5 font-bold text-xl">
                                        Layouts
                                    </h3>
                                </div>
                                <span class="ml-3 my-auto" v-if="displayLayout"
                                    ><ChevronUpIcon class="h-4 text-black"
                                /></span>
                                <span class="ml-3 my-auto" v-else
                                    ><ChevronDownIcon class="h-4 text-black"
                                /></span>
                            </div>
                            <ul class="px-6 mb-3" v-if="displayLayout">
                                <div
                                    class="
                                        flex
                                        justify-between
                                        text-cyan-700
                                        cursor-pointer
                                    "
                                    @click="popLayout"
                                >
                                    <p class="font-semibold text-lg">
                                        Add a new Layout
                                    </p>
                                    <i
                                        class="far fa-plus-square mx-0 my-auto"
                                    ></i>
                                </div>
                                <div
                                    v-for="file in all_files"
                                    :key="file.id"
                                >
                                    <li
                                        class="text-lg pt-4 cursor-pointer"
                                        @click="getContent(file)"
                                    >
                                        { } {{ file.title }}
                                    </li>
                                </div>
                            </ul>
                        </div>
                        <!-- Assets -->
                        <div>
                            <div
                                @click="toggleAsset"
                                class="
                                    flex
                                    min-h-0
                                    overflow-y-auto
                                    px-6
                                    pt-9
                                    justify-between
                                    cursor-pointer
                                "
                            >
                                <div class="flex">
                                    <img
                                        src="../../../assets/icons/download_icon.svg"
                                        alt="download-icon"
                                    />
                                    <h3 class="ml-4.5 font-bold text-xl">
                                        Assets
                                    </h3>
                                </div>
                                <span class="ml-3 my-auto" v-if="displayAsset"
                                    ><ChevronUpIcon class="h-4 text-black"
                                /></span>
                                <span class="ml-3 my-auto" v-else
                                    ><ChevronDownIcon class="h-4 text-black"
                                /></span>
                            </div>
                            <ul class="px-6 mb-3" v-if="displayAsset">
                                <div
                                    class="
                                        flex
                                        justify-between
                                        pt-4
                                        text-cyan-700
                                        cursor-pointer
                                    "
                                    @click="popAsset"
                                >
                                    <p class="font-semibold text-lg">
                                        Add a new Asset
                                    </p>
                                    <i
                                        class="far fa-plus-square mx-0 my-auto"
                                    ></i>
                                </div>
                                <div
                                    v-for="file in all_files"
                                    :key="file.id"
                                >
                                    <li
                                        class="text-lg pt-4 cursor-pointer"
                                        @click="getContent(file)"
                                    >
                                        { } {{ file.title }}
                                    </li>
                                </div>
                            </ul>
                        </div>
                        <!-- Snippets -->
                        <div>
                            <div
                                @click="toggleSnippet"
                                class="
                                    flex
                                    min-h-0
                                    overflow-y-auto
                                    px-6
                                    pt-9
                                    justify-between
                                    cursor-pointer
                                "
                            >
                                <div class="flex">
                                    <img
                                        src="../../../assets/icons/download_icon.svg"
                                        alt="download-icon"
                                    />
                                    <h3 class="ml-4.5 font-bold text-xl">
                                        Snippets
                                    </h3>
                                </div>
                                <span class="ml-3 my-auto" v-if="displaySnippet"
                                    ><ChevronUpIcon class="h-4 text-black"
                                /></span>
                                <span class="ml-3 my-auto" v-else
                                    ><ChevronDownIcon class="h-4 text-black"
                                /></span>
                            </div>
                            <ul class="px-6 mb-3" v-if="displaySnippet">
                                <span
                                    class="
                                        flex
                                        justify-between
                                        pt-4
                                        text-cyan-700
                                        cursor-pointer
                                    "
                                    @click="popSnippet"
                                >
                                    <p class="font-semibold text-lg">
                                        Add a new Snippet
                                    </p>
                                    <i
                                        class="far fa-plus-square mx-0 my-auto"
                                    ></i>
                                </span>
                                <div
                                    v-for="file in theme_files[4]"
                                    :key="file.id"
                                >
                                    <li
                                        class="text-lg pt-4 cursor-pointer"
                                        @click="setEd(file)"
                                    >
                                        { } {{ file.title }}
                                    </li>
                                </div>
                            </ul>
                        </div>
                    </ul>
                </nav>

                <!-- Main content -->
                <div class="flex-1 max-h-screen xl:overflow-y-auto">
                    <div class="mx-auto py-10 px-4 sm:px-6 lg:py-12">
                        <alert
                            id="alert"
                            v-if="notification"
                            :notification="notification"
                        />
                        <div class="flex justify-between pl-10 pr-4.5 bg-white">
                            <!-- Still Editing -->
                            <h3 class="my-auto text-lg font-semibold">
                                Unknown Title
                            </h3>
                            <div class="flex mt-4 mb-3">
                                <button
                                    class="
                                        px-4
                                        py-1
                                        border border-black
                                        bg-transparent
                                        text-gray-500
                                        font-semibold
                                        mr-4
                                        focus:outline-none
                                    "
                                >
                                    Delete File
                                </button>
                                <button
                                    class="
                                        px-4
                                        py-1
                                        border border-black
                                        bg-transparent
                                        text-gray-500
                                        font-semibold
                                        mr-4
                                        focus:outline-none
                                    "
                                >
                                    Rename
                                </button>
                                <button
                                    class="
                                        px-4
                                        py-1
                                        text-white
                                        bg-cyan-700
                                        focus:outline-none
                                    "
                                    @click="dataSumit"
                                >
                                    <i
                                        class="
                                            fas
                                            fa-spinner fa-pulse
                                            text-white
                                            m-2
                                        "
                                        v-if="loading"
                                    ></i
                                    >Save
                                </button>
                            </div>
                        </div>
                        <div
                            class="
                                overflow-x-scroll
                                h-10
                                bg-black
                                text-gray-400
                                pl-6
                                -mb-1
                            "
                        >
                            <div class="flex my-1 items-center">
                                <a
                                    v-for="file in openFile"
                                    :key="file.id"
                                    class="
                                        flex
                                        text-xs
                                        h-7
                                        my-auto
                                        py-1.5
                                        pl-4
                                        pr-3
                                        items-center
                                        cursor-pointer
                                    "
                                    :class="[
                                        popChild ? 'hidden' : '',
                                        file.title,
                                    ]"
                                >
                                    <XIcon
                                        class="h-3 my-auto text-gray-400 mr-4"
                                        @click="removeChild(file.theme_file_id)"
                                    />
                                    {{ file.name }}
                                </a>
                            </div>
                        </div>
                        <pop-up
                            v-if="popUp"
                            @close="popUp = false"
                            @createFile="createFile"
                            :text="text"
                            :creatingContent="creatingContent"
                            :loading="loading"
                        ></pop-up>
                        <v-ace-editor
                            v-model:value="editingContent.content"
                            :language="language"
                            @init="editorInit"
                            style="height: 600px; width: 100%"
                            :theme="theme"
                            :options="{
                                enableBasicAutocompletion: true,
                                enableLiveAutocompletion: true,
                                fontSize: 16,
                                useWorker: true,
                                highlightActiveLine: true,
                                //enableSnippets: true,
                                showLineNumbers: true,
                                tabSize: 2,
                                showPrintMargin: false,
                                showGutter: true,
                            }"
                        />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import Search from "../Search.vue";
import { VAceEditor } from "vue3-ace-editor";
import axios from "axios";
import PopUp from "./Components/PopUp";
import Alert from "../../Components/Alert";

import "ace-builds/webpack-resolver";
import "ace-builds/src-noconflict/mode-text";
import "ace-builds/src-noconflict/theme-chrome";
import "ace-builds/src-noconflict/mode-html";
import "ace-builds/src-noconflict/mode-javascript";
import "ace-builds/src-noconflict/mode-css";
import "ace-builds/src-noconflict/mode-twig";
import "ace-builds/src-noconflict/ace";
import "ace-builds/src-noconflict/ext-language_tools";

import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { ChevronLeftIcon } from "@heroicons/vue/solid";
import { ChevronDownIcon } from "@heroicons/vue/solid";
import { ChevronUpIcon } from "@heroicons/vue/solid";
import { XIcon } from "@heroicons/vue/solid";

const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};

export default {
    components: {
        AppLayout,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        VAceEditor,
        ChevronLeftIcon,
        ChevronUpIcon,
        ChevronDownIcon,
        PopUp,
        Alert,
        XIcon,
    },

    props: {
        theme_files: Object,
        open_files: Array,
    },

    data: function () {
        return {
            active_file_index: 0,
            language: "twig",
            loading: false,
            notification: null,
            editor: null,
            content: "",
            templateId: 1,
            displayLayout: true,
            displayTemplate: true,
            displayAsset: true,
            displaySnippet: true,
            editorHeader: "Template",
            popUp: false,
            text: "",
            child: "",
            open_filesCounter: 0,
            openFileCounter: 0,
            file: "Create a blank file",
            // theme: {},
            popChild: false,
            editingContent: {
                content: "",
            },
            creatingContent: {
                type_id: 0,
                content: "",
                asset_url: null,
                title: "",
                theme_id: 1,
                type: "",
            },
            openFile: {},
            showTempOpt: true,
            showLayOpt: true,
            showAssOpt: true,
            showSnipOpt: true,
            active: false,
        };
    },
    mounted() {
        this.openFile = this.open_files;
    },
    computed: {
        layout_files() {
            // return this.theme.filter()
            if (this.theme_files.hasOwnProperty("2")) {
                return this.theme_files["2"];
            }

            return [];
        },
        asset_files() {
            // return this.theme.filter()
            if (this.theme_files.hasOwnProperty("3")) {
                return this.theme_files["3"];
            }

            return [];
        },
        snippet_files() {
            // return this.theme.filter()
            if (this.theme_files.hasOwnProperty("4")) {
                return this.theme_files["4"];
            }

            return [];
        },
        template_files() {
            // return this.theme_files.filter()
            if (this.theme_files.hasOwnProperty("1")) {
                return this.theme_files["1"];
            }
            return [];
        },
    },
    methods: {
        async dataSumit() {
            this.loading = true;
            this.notification = null;
            try {
                const res = await axios.put(
                    `/online-store/code-editor/${this.editingContent.id}`,
                    this.editingContent
                );
                const { notification } = res.data;
                this.notification = notification;
                setTimeout(() => {
                    this.notification = null;
                }, 3000);
            } catch (error) {
                const { notification } = error.response.data;
                this.notification = notification;
            }
            this.loading = false;
            window.scrollTo({ top: 0, behavior: "smooth" });
        },
        async createFile() {
            this.popUp = false;
            this.loading = true;
            this.notification = null;
            console.log(this.open_files);
            //console.log(this.creatingContent)
            window.scrollTo({ top: 0, behavior: "smooth" });
            try {
                const res = await axios.post(
                    "/admin/online-store/code-editor",
                    this.creatingContent
                );
                const { notification } = res.data;
                this.open_files.push(res.data);
                this.notification = notification;
                // setTimeout(() => {
                //   this.notification = null;
                // }, 3000);
                //location.reload()
            } catch (error) {
                const { notification } = error.response.data;
                this.notification = notification;
            }
            this.loading = false;
            // setTimeout(() => {
            //   location.reload();
            // }, 3100);
        },

        async removeFileFrom(file) {
            try {
                await axios
                    .delete("/admin/online-store/editor-pages/" + file.id)
                    .then((res) => {});
            } catch (error) {
                alert("An Unknown error occurred");
            }
            this.loading = false;
            // window.scrollTo({ top: 0, behavior: 'smooth' });
        },

        setOpenFiles(file) {
            this.open_files.push(file);
            this.active_file_index = this.open_files.length - 1;
        },

        async getContent(file) {
            try {
                await axios
                    .get("/admin/online-store/code-editor/" + file.id)
                    .then((res) => {
                        //CHECKS IF THE CLICKED FILE IS AN OPEN TAB
                        this.content = res.data.content;
                        for (
                            let index = 0;
                            index < this.openFile.length;
                            index++
                        ) {
                            if (
                                this.openFile[index].theme_file_id ==
                                res.data.theme_file_id
                            ) {
                                this.openFileCounter++;
                            }
                        }
                        if (this.openFileCounter <= 0) {
                            this.openFiles = this.openFile.unshift(res.data);
                        }
                        //CHECKS IF THE CLICKED FILE IS IN THE OPEN_FILE ARRAY
                        for (
                            let index = 0;
                            index < this.open_files.length;
                            index++
                        ) {
                            if (
                                this.open_files[index].theme_file_id ==
                                res.data.theme_file_id
                            ) {
                                this.open_filesCounter++;
                            }
                        }
                    });
                if (this.open_filesCounter <= 0) {
                    this.open_files = this.open_files.push(res.data);
                }
                this.setEditorLang(res.data);
                this.content = res.data.content;

                this.notification = notification;
            } catch (error) {
                // const { notification } = error.response.data;
                // this.notification = notification;
            }
            this.loading = false;
            window.scrollTo({ top: 0, behavior: "smooth" });
        },
        setEditingContent() {
            if (this.open_files.length) {
                this.editingContent = this.open_files[this.active_file_index];
            }
        },
        editorInit: function () {},
        toggleLayout() {
            this.displayLayout = !this.displayLayout;
            //this.editorHeader = "Layout"
            if (this.displayLayout) {
                this.showLayOpt = true;
            }
        },
        toggleTemplate() {
            this.displayTemplate = !this.displayTemplate;
            //this.editorHeader = "Template";
            if (this.displayTemplate) {
                this.showTempOpt = true;
            }
        },
        toggleAsset() {
            this.displayAsset = !this.displayAsset;
            //this.editorHeader = "Asset"
            if (this.displayAsset) {
                this.showAssOpt = true;
            }
        },
        toggleSnippet() {
            this.displaySnippet = !this.displaySnippet;
            //this.editorHeader = "Snippet"
            if (this.displaySnippet) {
                this.showSnipOpt = true;
            }
        },
        setActive(file) {
            this.active_file_index = this.open_files.findIndex(
                (x) => x.id === file.id
            );
        },
        removeFile(file) {
            this.removeFileFrom(file);
            let index = this.open_files.findIndex((x) => x.id === file.id);
            this.open_files.splice(index, 1);
            //get a new active file index
            if (index == this.active_file_index) {
                if (index != 0) {
                    this.active_file_index = index - 1;
                } else {
                    this.active_file_index = 0;
                }
            }
        },
        popLayout() {
            this.popUp = true;
            this.text = "layout";
            this.creatingContent.type_id = 2;
            this.creatingContent.theme_id = 2;
        },
        popAsset() {
            this.popUp = true;
            this.text = "asset";
            this.creatingContent.type_id = 3;
            this.creatingContent.theme_id = 3;
        },
        popTemplate() {
            this.popUp = true;
            this.text = "template";
            this.creatingContent.type_id = 1;
            this.creatingContent.theme_id = 1;
        },
        popSnippet() {
            this.popUp = true;
            this.text = "snippet";
            this.creatingContent.type_id = 4;
            this.creatingContent.theme_id = 4;
        },
        setEditorLang(file) {
            if (file.title.indexOf(".css") > -1) {
                this.lang = "css";
            } else if (file.title.indexOf(".js") > -1) {
                this.lang = "javascript";
            } else if (file.title.indexOf(".twig")) {
                this.lang = "twig";
            }
        },
        removeChild(id) {
            let openedFile = [];
            for (let index = 0; index < this.openFile.length; index++) {
                if (this.openFile[index].theme_file_id != id) {
                    openedFile.push(this.openFile[index]);
                }
            }
            this.openFile = openedFile;
            return this.openFile;
        },

        setEditor(file) {
            this.setEditorLang(file);
            this.editingContent = file;
            if (file.name.indexOf(".css") > -1) {
                this.language = "css";
            } else if (file.name.indexOf(".js") > -1) {
                this.language = "javascript";
            } else if (file.name.indexOf(".twig")) {
                this.language = "twig";
            }
        },
    },
    setup() {
        const open = ref(false);
        return {
            statusStyles,
        };
    },
};
</script>
