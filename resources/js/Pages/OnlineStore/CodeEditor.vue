<template>
  <!-- FONT AWESOME LINK -->
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous"
  />
  <!-- FONT AWESOME LINK -->

  <app-layout
      id="top"
      :navigation="navigation"
  >
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
            <p class="text-lg font-medium text-gray-900">Code Editor</p>
          </div>
          <div v-for="(fileGroup, index) in files">
              <div
                class="flex justify-between cursor-pointer text-cyan-700"
                @click="doPopUp(index)"
              >
                  <p>{{  index }}</p>
                <p class="text-sm">Add new</p>
                <i class="far fa-plus-square mx-0 my-auto"></i>
              </div>
              <div v-for="file in fileGroup" :key="file.id">
                <div
                  class="text-lg pt-a  cursor-pointer"
                  @click="getContent(file)"
                >
                  { } {{ file.title }}
                </div>
              </div>
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
                <button class="px-4 py-1 border border-black bg-transparent text-gray-500 font-semibold mr-4
                    focus:outline-none">
                  Delete File
                </button>
                <button class="px-4 py-1 border border-black bg-transparent text-gray-500 font-semibold mr-4
                    focus:outline-none">
                  Rename
                </button>
                <button class="px-4 py-1 text-white bg-cyan-700 focus:outline-none" @click="dataSumit">
                  <i class="fas fa-spinner fa-pulse text-white m-2" v-if="loading"></i>Save
                </button>
              </div>
            </div>
            <div class="overflow-x-scroll">
              <span v-for="file in open_files" :key="file.id" class="inline-flex items-center py-0.5 pl-2.5 pr-1 text-sm font-medium bg-indigo-100 text-indigo-700 mr-2 cursor-pointer">
                  <span class="flex pr-3 pl-3" @click="setActive(file)">{{ file.title }}</span>
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
              @uploadFile="uploadFile"
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
import { VAceEditor } from 'enkoded-ace';
import axios from 'axios';
import PopUp from './Components/PopUp';
import Alert from '../../Components/Alert';
import {fileUploader} from "../../api";
import urls from "../../api/urls";


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
        open_files: Array,
        theme: Object,
        navigation: Object,
        files: Object,
        theme_id: Number
  },

  data: function () {
    return {
      active_file_index: 0,
      language: 'twig',
      loading: false,
      notification: null,
      editor: null,
      content: '',
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
        type: ''
      },
      openFile: {},
      showTempOpt: true,
      showLayOpt: true,
      showAssOpt: true,
      showSnipOpt: true,
      active: false,
      all_files: {}
    };
  },
  mounted() {
    this.setEditingContent();
    //console.log(this.open_files)
    this.all_files = this.theme_files
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
  methods: {
    async dataSumit() {
      this.loading = true;
      this.notification = null;
      try {
        const res = await axios.put(
          `/admin/online-store/code-editor/${this.editingContent.id}`,
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
    async createFile(params) {
      this.popUp = false;
      this.loading = true;
      this.notification = null;
      window.scrollTo({ top: 0, behavior: 'smooth' });
      try {
          this.creatingContent.theme_id = this.theme_id
        const res = await axios.post(
          '/admin/online-store/code-editor',
          this.creatingContent
        );

          const { notification } = res.data;

        let file = res.data.open_files
        this.setOpenFiles(file)

        this.all_files = res.data.theme_files
        this.notification = notification;
      } catch (error) {
        const { notification } = error.response.data;
        this.notification = notification;
      }
      this.loading = false;
      // setTimeout(() => {
      //   location.reload();
      // }, 3100);
    },
    doPopUp(type) {
        this.popUp = true;
        this.text = type;
        this.creatingContent.type = type
    },
    async removeFileFrom(file) {
      try {
        await axios.delete('/admin/online-store/editor-pages/' + file.id)
        .then((res)=>{

        })

      } catch (error) {
        alert('An Unknown error occurred')
      }
      this.loading = false;
      // window.scrollTo({ top: 0, behavior: 'smooth' });
    },

    setOpenFiles(file) {
      this.open_files.push(file)
      this.active_file_index = this.open_files.length-1;
    },

    async getContent(file) {
      try {
        await axios.get('/admin/online-store/code-editor/' + file.id)
        .then((res)=>{
            // this.setEditorLang(res.data);
            this.content = res.data.content
            let file = res.data
            this.setOpenFiles(file)
            this.editingContent = this.open_files[this.open_files.length-1]
            this.setEditorLang(res.data);
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
      this.removeFileFrom(file)
      let index = this.open_files.findIndex( x => x.id === file.id );
      this.open_files.splice(index, 1);
      //get a new active file index
      if(index == this.active_file_index) {
          if(index != 0) {
            this.active_file_index = index-1;
          }else{
            this.active_file_index = 0;
          }
      }
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
  setup(props) {
    const open = ref(false);
    const uploadFile = async(file) => {
        let params = {};
        params.files = file;
        params.theme_id = props.theme_id
      let uploader = await fileUploader(urls.assets.uploader(), params);
      console.log(uploader)
    }
    return {
        statusStyles,
        uploadFile
    };
  }
};
</script>
