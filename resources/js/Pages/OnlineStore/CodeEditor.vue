<template>
  <!-- FONT AWESOME LINK -->
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous"
  />
  <!-- FONT AWESOME LINK -->

  <app-layout id="top">
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
            <p class="text-lg font-medium text-blue-gray-900">Code Editor</p>
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
                <p class="ml-4.5 font-bold text-xl">Templates</p>
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
                class="flex justify-between cursor-pointer text-cyan-700"
                @click="popTemplate"
              >
                <p class="font-semibold text-lg">Add a new Template</p>
                <i class="far fa-plus-square mx-0 my-auto"></i>
              </div>
              <div v-for="file in theme_files[1]" :key="file.id">
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
                <h3 class="ml-4.5 font-bold text-xl">Layouts</h3>
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
                class="flex justify-between text-cyan-700 cursor-pointer"
                @click="popLayout"
              >
                <p class="font-semibold text-lg">Add a new Layout</p>
                <i class="far fa-plus-square mx-0 my-auto"></i>
              </div>
              <div v-for="file in theme_files[2]" :key="file.id">
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
                class="flex justify-between pt-4 text-cyan-700 cursor-pointer"
                @click="popAsset"
              >
                <p class="font-semibold text-lg">Add a new Asset</p>
                <i class="far fa-plus-square mx-0 my-auto"></i>
              </div>
              <div v-for="file in theme_files[3]" :key="file.id">
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
                <h3 class="ml-4.5 font-bold text-xl">Snippets</h3>
              </div>
              <span class="ml-3" v-if="displaySnippet"
                ><i class="fas fa-chevron-up"></i
              ></span>
              <span class="ml-3" v-else
                ><i class="fas fa-chevron-down"></i
              ></span>
            </div>
            <ul class="px-6 mb-3" v-if="displaySnippet">
              <span
                class="flex justify-between pt-4 text-cyan-700 cursor-pointer"
                @click="popSnippet"
              >
                <p class="font-semibold text-lg">Add a new Snippet</p>
                <i class="far fa-plus-square mx-0 my-auto"></i>
              </span>
              <div v-for="file in theme_files[4]" :key="file.id">
                <li
                  class="text-lg pt-4 cursor-pointer"
                  @click="setEd(file)"
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
            <alert
              id="alert"
              v-if="notification"
              :notification="notification"
            />
            <div class="flex justify-between pl-10 pr-4.5 bg-white">
              <!-- Still Editing -->
              <h3 class="my-auto text-lg font-semibold">Unknown Title</h3>
              <div class="flex mt-4 mb-3">
                <button
                  class="px-4
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
                  class="px-4 py-1 text-white bg-cyan-700 focus:outline-none"
                  @click="dataSumit"
                >
                  <i
                    class="fas fa-spinner fa-pulse text-white m-2"
                    v-if="loading"
                  ></i
                  >Save
                </button>
              </div>
            </div>
            <div class="overflow-x-scroll">
              <span v-for="file in open_files" :key="file.id" class="inline-flex items-center py-0.5 pl-2.5 pr-1 text-sm font-medium bg-indigo-100 text-indigo-700 mr-2 cursor-pointer">
                  <span class="flex pr-3 pl-3" @click="setActive(file)">{{ file.name }}</span>
                  <button type="button" class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white" @click="removeFile(file)">
                    <span class="sr-only">Close File </span>
                    <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                      <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                    </svg>
                  </button>
              </span>
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
              :lang="language"
              style="height: 600px; width: 100%"
              :theme="theme"
              :options="{
                fontSize: 16,
                useWorker: true,
                highlightActiveLine: true,
                showLineNumbers: true,
                tabSize: 2,
                showPrintMargin: false,
                showGutter: true

              }"
            />
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { ref } from 'vue';
import AppLayout from '../../Layouts/AppLayout.vue';
import Search from '../Search.vue';
import { VAceEditor } from 'vue3-ace-editor';
import axios from 'axios';
import PopUp from './Components/PopUp';
import Alert from '../../Components/Alert';


import 'ace-builds/src-noconflict/mode-text';
import 'ace-builds/src-noconflict/theme-chrome';
import 'ace-builds/src-noconflict/mode-html';
import 'ace-builds/src-noconflict/mode-javascript';
import 'ace-builds/src-noconflict/mode-css';
import 'ace-builds/src-noconflict/mode-twig';
import 'ace-builds/src-noconflict/ace';
import 'ace-builds/src-noconflict/ext-language_tools';

import {
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot
} from '@headlessui/vue';

import { ChevronLeftIcon } from '@heroicons/vue/solid';
import { ChevronDownIcon } from '@heroicons/vue/solid';
import { ChevronUpIcon } from '@heroicons/vue/solid';

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800'
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
    Alert
  },

  props: {
    theme_files: Object,
    open_files: Array
  },

  data: function () {
    return {
      active_file_index: 0,
      language: 'twig',
      loading: false,
      notification: null,
      editor: null,
      content: '',
      templateId: 1,
      displayLayout: true,
      displayTemplate: true,
      displayAsset: true,
      displaySnippet: true,
      editorHeader: 'Template',
      popUp: false,
      theme: "chrome",
      editingContent: {
        'content': ''
      },
      text: '',
      child: '',
      file: 'Create a blank file',
      // theme: {},
      popChild: false,
      creatingContent: {
        type_id: 0,
        content: '',
        asset_url: null,
        title: '',
        theme_id: 1,
        type: ''
      },
      openFile: {},
      showTempOpt: true,
      showLayOpt: true,
      showAssOpt: true,
      showSnipOpt: true,
      active: false
    };
  },
  mounted() {
    this.setEditingContent();
    //console.log(this.open_files)
  },
  watch: {
    active_file_index: function(val) {
      if(this.open_files.length) {
          this.editingContent = this.open_files[val]
          this.setEditorLang(this.open_files[val])
      }else{
          this.editingContent = {
              content: ''
          }
      }
    }
  },
  computed: {
    layout_files() {
      // return this.theme.filter()
      if (this.theme_files.hasOwnProperty('1')) {
        return this.theme_files['1'];
      }

      return [];
    },
    asset_files() {
      // return this.theme.filter()
      if (this.theme_files.hasOwnProperty('1')) {
        return this.theme_files['3'];
      }

      return [];
    },
    snippet_files() {
      // return this.theme.filter()
      if (this.theme_files.hasOwnProperty('1')) {
        return this.theme_files['4'];
      }

      return [];
    },
    template_files() {
      // return this.theme_files.filter()
      if (this.theme_files.hasOwnProperty('1')) {
        return this.theme_files['2'];
      }
      return [];
    }
 
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
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    async createFile() {
      this.popUp = false;
      this.loading = true;
      this.notification = null;
      console.log(this.open_files);
      //console.log(this.creatingContent)
      window.scrollTo({ top: 0, behavior: 'smooth' });
      try {
        const res = await axios.post(
          '/online-store/code-editor',
          this.creatingContent
        );
        const { notification } = res.data;
        this.open_files.push(res.data)
        this.notification = notification;
        setTimeout(() => {
          this.notification = null;
        }, 3000);
        //location.reload()
      } catch (error) {
        const { notification } = error.response.data;
        this.notification = notification;
      }
      this.loading = false;
      setTimeout(() => {
        location.reload();
      }, 3100);
    },

    async getContent(file) {
      try {
        await axios.get('/online-store/code-editor/' + file.id)
        .then((res)=>{
            // this.setEditorLang(res.data); 
            this.content = res.data.content
            this.open_files.push(res.data)
            // this.setEditorLang(res.data);
        }) 
        
        this.content = res.data.content;
        
        this.notification = notification;
      } catch (error) {
        // const { notification } = error.response.data;
        // this.notification = notification;
      }
      this.loading = false;
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    setEditingContent() {
      if(this.open_files.length) {
          this.editingContent =  this.open_files[this.active_file_index]
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
        this.active_file_index = this.open_files.findIndex( x => x.id === file.id );  
    },
    removeFile(file) {
      let index = this.open_files.findIndex( x => x.id === file.id );
      this.open_files.splice(index, 1);
      //get a new active file index
      if(index == this.active_file_index) {
          if(index != 0) {
            this.active_file_index = index-1;
          }else{
            this.active_file_index = 0;
          } 

          // if(open_files.length){
          //     this.editingContent = this.open_files[this.active_file_index]
          // }else{
          //   this.editingContent = 
          // }
      }
      
      //Delete from open files
      // console.log(index);
    },
    popLayout() {
      this.popUp = true;
      this.text = 'layout';
      this.creatingContent.type_id = 2;
      this.creatingContent.theme_id = 2;
    },
    popAsset() {
      this.popUp = true;
      this.text = 'asset';
      this.creatingContent.type_id = 3;
      this.creatingContent.theme_id = 3;
    },
    popTemplate() {
      this.popUp = true;
      this.text = 'template';
      this.creatingContent.type_id = 1;
      this.creatingContent.theme_id = 1;
    },
    popSnippet() {
      this.popUp = true;
      this.text = 'snippet';
      this.creatingContent.type_id = 4;
      this.creatingContent.theme_id = 4;
    },
    setEditorLang(file) {
      if (file.name.indexOf('.css') > -1) {
        this.language = 'css';
      } else if (file.name.indexOf('.js') > -1) {
        this.language = 'javascript';
      } else if (file.name.indexOf('.twig')) {
        this.language = 'twig';
      }
    },
    removeChild(id) {
      //"theme_files.1.0.id"
      this.child = document.getElementsByClassName(id)[0].innerText;
      //console.log(document.getElementsByClassName(id).innerText)
      //console.log(id)
      //document.getElementsByClassName(id)
      //if(document.getElementsByClassName(id))

      if (id == this.child) {
        this.popChild = true;
      } else {
        console.log('Nah');
      }
    },

    setEditor(file) {
      this.setEditorLang(file);
      this.editingContent = file;
    }
  },
  setup() {
    const open = ref(false);
    return {
      statusStyles
    };
  }
};
</script>
