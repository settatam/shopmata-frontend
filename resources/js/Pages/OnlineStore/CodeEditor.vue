<template>
    <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
          <nav aria-label="Breadcrumb" class="bg-white border-b border-blue-gray-200 xl:hidden">
            <div class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8">
              <inertia-link href="#" class="-ml-1 inline-flex items-center space-x-3 text-sm font-medium text-blue-gray-900">
                <ChevronLeftIcon class="h-5 w-5 text-blue-gray-400" aria-hidden="true" />
                <span>Settings</span>
              </inertia-link>
            </div>
          </nav>

          <div class="flex-1 flex xl:overflow-hidden">
            <!-- Secondary sidebar -->
            <nav aria-label="Sections" class="hidden flex-shrink-0 w-96 bg-white border-r border-blue-gray-200 xl:flex xl:flex-col">
              <div class="flex-shrink-0 h-16 px-6 border-b border-blue-gray-200 flex items-center">
                  <p class="text-lg font-medium text-blue-gray-900">Settings</p>
              </div>
              <div class="flex-1 min-h-0 overflow-y-auto">
                  <ul class="layouts mb-3" v-if="displayTemplate">
                        <span
                          class="
                            flex
                            justify-between
                            text-purple-darker
                            cursor-pointer
                            pt-4
                          "
                          @click="popTemplate"
                        >
                          <p class="font-semibold text-lg">Add a new Template</p>
                          <i class="far fa-plus-square mx-0 my-auto"></i>
                        </span>
                        <div v-for="file in layout_files" :key="file.id">
                          <li
                            class="text-lg pt-4 cursor-pointer"
                            @click="setEditor(file)" 
                          >
                             { } {{ file.title }}
                          </li>
                        </div>
                      </ul>
                      <div
                        @click="toggleLayout"
                        class="flex justify-between cursor-pointer"
                      >
                        <div class="flex">
                          <img
                            src="../../../assets/icons/download_icon.svg"
                            alt="download-icon"
                          />
                          <h3 class="ml-4.5 font-bold text-xl">Layouts</h3>
                        </div>
                        <span class="ml-3" v-if="displayLayout"
                          ><i class="fas fa-chevron-up"></i
                        ></span>
                        <span class="ml-3" v-else
                          ><i class="fas fa-chevron-down"></i
                        ></span>
                      </div>
                      <ul class="templates mb-3" v-if="displayLayout">
                        <span
                          class="flex justify-between text-purple-darker cursor-pointer pt-4"
                          @click="popLayout">
                          <p class="font-semibold text-lg">Add a new Layout</p>
                          <i class="far fa-plus-square mx-0 my-auto"></i>
                        </span>
                        <div v-for="file in template_files" :key="file.id">
                          <li
                            class="text-lg pt-4 cursor-pointer"
                            @click="setEditor(file)"
                          >
                            { } {{ file.title }}
                          </li>
                        </div>
                      </ul>
                </div>
            </nav>

            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="mx-auto py-10 px-4 sm:px-6 lg:py-12">
               <v-ace-editor
                  v-model:value="content"
                  @init="editorInit"
                  lang="twig"
                  theme="chrome"
                  style="height: 600px; width: 100%"
                  :options="{
                    enableBasicAutocompletion: true,
                    enableLiveAutocompletion: true,
                    fontSize: 14,
                    highlightActiveLine: true,
                    enableSnippets: true,
                    showLineNumbers: true,
                    tabSize: 2,
                    showPrintMargin: false,
                    showGutter: true,
                  }"
                  :commands="[
                    {
                      name: 'save',
                      bindKey: { win: 'Ctrl-s', mac: 'Command-s' },
                      exec: dataSumit,
                      readOnly: true,
                    },
                  ]"
                  />
              </div>
            </div>
          </div>
        </div>
    </app-layout>
</template>

<script>

import { ref } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import Search from '../Search.vue'
import axios from "axios"
import { VAceEditor } from 'vue3-ace-editor';

import 'ace-builds/src-noconflict/mode-text';
import 'ace-builds/src-noconflict/theme-chrome';
import 'ace-builds/src-noconflict/mode-html';
import 'ace-builds/src-noconflict/mode-javascript';
import 'ace-builds/src-noconflict/mode-css';
import 'ace-builds/src-noconflict/mode-twig';

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon } from '@heroicons/vue/solid'

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}

props: {
  
}

export default {
  components: {
    AppLayout,
    Dialog, 
    DialogOverlay, 
    TransitionChild, 
    TransitionRoot,
    VAceEditor
  },
  
  mounted() {
    // console.log(this.user);
  },

  data: function () {
    return {
      lang:'twig',
      loading: false,
      notification: null,
      editor: null,
      content: "",
      templateId: 1,
      displayLayout: false,
      displayTemplate: true,
      displayAsset: false,
      displaySnippet: false,
      editorHeader: "Template",
      popUp: false,
      text: "",
      file: "Create a blank file",
      editingContent: {
        content: "",
      },
      creatingContent: {
        type_id: 0,
        content: "",
        asset_url: null,
        title: "",
        theme_id: 1,
        type: ""
      },
      showTempOpt:true,
      showLayOpt:false,
      showAssOpt:false,
      showSnipOpt:false,
      active: false,
    };
  },
  computed: {
    layout_files() {
      // return this.theme_files.filter()
      // if (this.theme_files.hasOwnProperty("1")) {
      //   return this.theme_files["1"];
      // }

      return [];
    },
    asset_files() {
      // return this.theme_files.filter()
      // if (this.theme_files.hasOwnProperty("1")) {
      //   return this.theme_files["3"];
      // }

      return [];
    },
    template_files() {
      // return this.theme_files.filter()
      // if (this.theme_files.hasOwnProperty("1")) {
      //   return this.theme_files["2"];
      // }
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
          this.notification = null
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
      console.log(this.creatingContent)
      try {
        const res = await axios.post(
          "/online-store/code-editor",  
          this.creatingContent
        );
        const { notification } = res.data;
        this.notification = notification;
        location.reload()
      } catch (error) {
        const { notification } = error.response.data;
        this.notification = notification;
      }
      this.loading = false;
      window.scrollTo({ top: 0, behavior: "smooth" });
    },
    editorInit: function () {

    },
    toggleLayout() {
      this.displayLayout = !this.displayLayout;
      this.editorHeader = "Layout"
      if (this.displayLayout) {
        this.displayTemplate = false;
        this.displayAsset = false;
        this.displaySnippet = false;
        this.showTempOpt=false;
        this.showLayOpt=true;
        this.showAssOpt=false;
        this.showSnipOpt=false;
      }
    },
    toggleTemplate() {
      this.displayTemplate = !this.displayTemplate;
      this.editorHeader = "Template";

      if (this.displayTemplate) {
        this.displayLayout = false;
        this.displayAsset = false;
        this.displaySnippet = false;
        this.showTempOpt=true;
        this.showLayOpt=false;
        this.showAssOpt=false;
        this.showSnipOpt=false;
      }
    },
    toggleAsset() {
      this.displayAsset = !this.displayAsset;
      this.editorHeader = "Asset"
      if (this.displayAsset) {
        this.displayTemplate = false;
        this.displayLayout = false;
        this.displaySnippet = false;
        this.showTempOpt=false;
        this.showLayOpt=false;
        this.showAssOpt=true;
        this.showSnipOpt=false;
      }
    },
    toggleSnippet() {
      this.displaySnippet= !this.displaySnippet;
      this.editorHeader = "Snippet"
      if (this.displaySnippet) {
        this.displayTemplate = false;
        this.displayAsset = false;
        this.displayLayout = false;
        this.showTempOpt=false;
        this.showLayOpt=false;
        this.showAssOpt=false;
        this.showSnipOpt=true;
      }
    },
    popLayout() {
      this.popUp = true;
      this.text = "layout";
      this.creatingContent.type_id = 2
      this.creatingContent.theme_id = 2
    },
    popAsset() {
      this.popUp = true;
      this.text = "asset";
      this.creatingContent.type_id = 3
      this.creatingContent.theme_id = 3
    },
    popTemplate() {
      this.popUp = true;
      this.text = "template";
      this.creatingContent.type_id = 1
      this.creatingContent.theme_id = 1
    },
    popSnippet() {
      this.popUp = true;
      this.text = "snippet";
      this.creatingContent.type_id = 4
      this.creatingContent.theme_id = 4
    },
    setEditorLang(file) {
      if(file.title.indexOf('.css') > -1) {
          this.lang = 'css';
      }else if(file.title.indexOf('.js') > -1){
         this.lang = 'javascript';
      }else if(file.title.indexOf('.twig')) {
        this.lang = 'twig';
      }
    },
    setEditor(file) {
      this.setEditorLang(file);
      this.editingContent = file;
    },
  },
  setup() {
    const open = ref(false)
    return {
      statusStyles,
    }
  },

}
</script>

