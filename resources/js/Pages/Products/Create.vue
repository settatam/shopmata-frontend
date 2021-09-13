<template>
  <app-layout>
    <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
      <!-- Breadcrumb -->
      <nav
        aria-label="Breadcrumb"
        class="bg-white border-b border-blue-gray-200 xl:hidden"
      >
        <div class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8">
          <inertia-link href="#" class=" -ml-1 inline-flex items-center space-x-3 text-sm font-medium text-blue-gray-900">
            <ChevronLeftIcon
              class="h-5 w-5 text-blue-gray-400"
              aria-hidden="true"
            />
            <span>Add Product</span>
          </inertia-link>
        </div>
      </nav>

      <div class="flex-1 flex xl:overflow-hidden">
        <!-- Secondary sidebar -->

        <!-- Main content -->
        <div class="flex-1 max-h-screen xl:overflow-y-auto">
          <div class="max-w-3xl py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
            <h1 class="text-2xl font-extrabold text-blue-gray-900">
              Add New Product
            </h1>
            <!-- <form @submit.prevent="submit">
              <div class="bg-white mb-10 pt-7">
                <div
                  class="bg-white flex justify-between px-8 cursor-pointer"
                  @click="expandForm"
                >
                  <p class="text-black text-2xl font-semilbold mb-6">
                    Add Product
                  </p>
                  <span><angle-up-icon></angle-up-icon></span>
                </div>
                <div class="bg-white px-8 pb-6 mb-6" v-if="expand">
                  <p class="text-black text-2xl font-semilbold mb-6">Update Product</p>
                  <div class="mb-10">
                    <label
                      class="block text-black font-semibold mb-2 bg-transparent"
                      for="title"
                    >
                      Title
                    </label>
                    <input
                      class="appearance-none border border-gray-300 rounded-md bg-transparent w-full py-2 px-3 text-black leading-tight focus:outline-none"
                      type="text"
                      placeholder="Cargo Pants"
                      v-model="formFields.title"
                    />
                     <span v-if="v$.formFields.title.$error" class="text-red-400">
                            {{v$.formFields.title.$errors[0].$message}}
                        </span>
                  </div>
                  <div class="mb-6">
                    <label
                      class="block text-black font-semibold mb-2 bg-transparent"
                      for="description"
                    >
                      Description
                    </label>
                    <div class="quill border-gray-300 rounded-md">
                      <quill-editor
                        class="editor text-black"
                        ref="description"
                        theme="snow"
                        style="min-height: 300px"
                        :value="formFields.description"
                        :options="editorOption"
                        @change="onEditorChange"
                        @blur="onEditorBlur($event)"
                        @focus="onEditorFocus($event)"
                        @ready="onEditorReady($event)"
                      />
                       <span v-if="v$.formFields.description.$error" class="text-red-400">
                            {{v$.formFields.description.$errors[0].$message}}
                        </span>
                    </div>
                    
                  </div>
                  <div class="mt-20">
                    <label
                      class="block text-black font-semibold mb-2 bg-transparent"
                      for="brand"
                    >
                      Brand
                    </label>
                    <multiselect
                      v-model="formFields.brand"
                      placeholder="Pick a brand"
                      label="name"
                      trackBy="name"
                      valueProp="id"
                      :options="brands"
                      searchable="true"
                      class="text-xs text-black font-semibold"
                    ></multiselect>
                     <span v-if="v$.formFields.brand.$error" class="text-red-400">
                            {{v$.formFields.brand.$errors[0].$message}}
                        </span>
                  </div>
                </div>
              </div>

              <div class="bg-white mb-10 py-6">
                <div class="px-8">
                  <div
                    class="bg-white flex justify-between cursor-pointer"
                    @click="expandMediaForm"
                  >
                    <p class="text-black font-semibold text-lg mb-6">Media</p>
                    <div class="flex">
                      
                    </div>
                  </div>
                  <div>
                    <Dropzone></Dropzone>
                  </div>
                </div>
              </div>
              <pricing-form :pricing="pricing"></pricing-form>
              <inventory-form
                :inventory="inventory"
                :categories="categories"
              ></inventory-form>
              <shipping-form :shipping="shipping"></shipping-form>
              <variants-form
                :variants="variants"
                :types="variant_types"
                :valueContent="valueContent"
                :variantList="variantList"
                @added="addOption"
                @add-variant-name="addVariantName"
                @added-variant-value="addVariantValue"
              ></variants-form>
              <search-engine-form :search="search"></search-engine-form>
              <div class="text-center  pt-6 pb-6 mb-6">
                <t-button
                  class="text-white bg-indigo-700 active:bg-indigo-700 font-medium border border-transparent px-11 py-3.5 cursor-pointer rounded-md"
                  @click="submit"
                  >Add Product</t-button
                >
              </div>
            </form> -->
          </div>
            <div class="flex pl-6">
              <div class="bg-white h-screen w-52 mr-5 pt-7 pl-4.5">
                <p :class="activeGeneral?'text-indigo-700  border-l border-indigo-700':'text-gray-500'" class="mb-4 pl-2 py-1 ">General</p>
                <p :class="activeData?'text-indigo-700  border-l border-indigo-700':'text-gray-500' " class="mb-4 pl-2 py-1 ">Data</p>
                <p :class="activeVariants?'text-indigo-700  border-l border-indigo-700':'text-gray-500' " class="mb-4 pl-2 py-1 ">Variants</p>
                <p :class="activeImages?'text-indigo-700  border-l border-indigo-700':'text-gray-500' " class="mb-4 pl-2 py-1 ">Images</p>
                <p :class="activePricing?'text-indigo-700  border-l border-indigo-700':'text-gray-500' " class="mb-4 pl-2 py-1 ">Pricing</p>
                <p :class="activeLinks?'text-indigo-700  border-l border-indigo-700':'text-gray-500' " class="mb-4 pl-2 py-1 ">Links</p>
                <p :class="activeShipping?'text-indigo-700  border-l border-indigo-700':'text-gray-500' " class="mb-4 pl-2 py-1 ">Shipping</p>
                <p :class="activeInventory?'text-indigo-700  border-l border-indigo-700':'text-gray-500' " class="mb-4 pl-2 py-1 ">Inventory</p>
                <p :class="activeSEO?'text-indigo-700  border-l border-indigo-700':'text-gray-500' " class="mb-4 pl-2 py-1 ">SEO</p>
              </div>
              <General v-if="activeGeneral"/>
              <Data v-if="activeData"/>
              <Variants v-if="activeVariants"/>
              <Images v-if="activeImages"/>
              <Pricing v-if="activePricing"/>
              <Links v-if="activeLinks"/>
              <Shipping v-if="activeShipping"/>
              <Inventory v-if="activeInventory"/>
              <SEO v-if="activeSEO"/>
            </div>
        </div>
        <!-- <Nav page="General"></Nav> -->
      </div>
    </div>
  </app-layout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import Search from "../Search.vue";
import Nav from "../../Layouts/Nav";
import axios from "axios";
import useVuelidate from '@vuelidate/core'
import { required,helpers } from '@vuelidate/validators'

import {
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { ChevronLeftIcon } from "@heroicons/vue/solid";
import hljs from "highlight.js";
import Inventory from "./Components/Inventory";
import Shipping from "./Components/Shipping";
import Variants from "./Components/Variants";
import SEO from "./Components/SEO";
import Images from "./Components/Images";
import Pricing from "./Components/Pricing";
import General from "./Components/General";
import Data from "./Components/Data";
import Links from "./Components/Links";
import Dropzone from "./Components/Dropzone";
import UploadIcon from "../../../assets/UploadIcon";
import AngleUpIcon from "../../../assets/AngleUpIcon";
import Multiselect from "@vueform/multiselect";
// import "vue-multiselect/dist/vue-multiselect.min.css";



const statusStyles = {
  success: "bg-green-100 text-green-800",
  processing: "bg-yellow-100 text-yellow-800",
  failed: "bg-gray-100 text-gray-800",
};
export default {
  props: {
    products: Object,
    filters: Object,
    brands: Array,
    categories: Array,
  },

  components: {
    Nav,
    AppLayout,
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    Multiselect,
    // InventoryForm,
    Shipping,
    Variants,
    Images,
    Inventory,
    Links,
    SEO,
    Pricing,
    General,
    Data,
    UploadIcon,
    AngleUpIcon,
    Dropzone
  },

  data() {
    return {
      v$: useVuelidate(),
      activeGeneral:false,
      activeData:false,
      activeVariants:true,
      activeImages:false,
      activePricing:false,
      activeLinks:false,
      activeShipping:false,
      activeInventory:false,
      activeSEO:false,
      valueContent: '',
      variantList: [],
      dropzoneOptions: {
        url: "/product-images",
        thumbnailWidth: 150,
        maxFilesize: 0.5,
        addRemoveLinks: true,
        headers: { "My-Awesome-Header": "header value" },
        dictDefaultMessage: `<span><svg class="inline mb-3" xmlns="http://www.w3.org/2000/svg" width="72" height="58" viewBox="0 0 72 58" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M19.827 6.039C24.3247 2.16061 30.0611 0.0186233 36 0C48.105 0 58.1535 9 59.247 20.6055C66.411 21.618 72 27.6165 72 34.9785C72 43.0605 65.259 49.5 57.0915 49.5H45C44.4033 49.5 43.831 49.2629 43.409 48.841C42.9871 48.419 42.75 47.8467 42.75 47.25C42.75 46.6533 42.9871 46.081 43.409 45.659C43.831 45.2371 44.4033 45 45 45H57.096C62.9055 45 67.5 40.446 67.5 34.9785C67.5 29.5065 62.91 24.9525 57.0915 24.9525H54.8415V22.7025C54.846 12.7125 46.476 4.5 36 4.5C31.1394 4.51942 26.4458 6.27495 22.7655 9.45C19.359 12.384 17.577 15.921 17.577 18.6975V20.7135L15.5745 20.934C9.288 21.6225 4.5 26.784 4.5 32.931C4.5 39.5325 10.035 45 17.0145 45H27C27.5967 45 28.169 45.2371 28.591 45.659C29.0129 46.081 29.25 46.6533 29.25 47.25C29.25 47.8467 29.0129 48.419 28.591 48.841C28.169 49.2629 27.5967 49.5 27 49.5H17.0145C7.686 49.5 0 42.147 0 32.931C0 24.9975 5.697 18.4275 13.239 16.7625C13.8825 12.879 16.38 9.009 19.827 6.039Z" fill="#CCCCCC"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M35.438 28.3899C35.5626 28.265 35.7105 28.166 35.8734 28.0984C36.0363 28.0308 36.2109 27.996 36.3873 27.996C36.5637 27.996 36.7383 28.0308 36.9012 28.0984C37.0641 28.166 37.212 28.265 37.3366 28.3899L45.3814 36.4347C45.6331 36.6865 45.7746 37.0279 45.7746 37.384C45.7746 37.7401 45.6331 38.0815 45.3814 38.3333C45.1296 38.5851 44.7881 38.7265 44.4321 38.7265C44.076 38.7265 43.7346 38.5851 43.4828 38.3333L37.7281 32.5759V56.1552C37.7281 56.5108 37.5868 56.8518 37.3354 57.1033C37.0839 57.3547 36.7429 57.496 36.3873 57.496C36.0317 57.496 35.6907 57.3547 35.4392 57.1033C35.1878 56.8518 35.0465 56.5108 35.0465 56.1552V32.5759L29.2918 38.3333C29.04 38.5851 28.6985 38.7265 28.3425 38.7265C27.9864 38.7265 27.645 38.5851 27.3932 38.3333C27.1414 38.0815 27 37.7401 27 37.384C27 37.0279 27.1414 36.6865 27.3932 36.4347L35.438 28.3899Z" fill="#632A6D"/></span><br/><p class="m-4">Drag and drop your image here or </p><br/> <t-button class="text-white bg-purple-darker active:bg-purple-darker font-medium border border-transparent px-4 py-3.5" type="submit">Choose File</t-button>`,
      },
      expand: true,
      expandMedia: true,
      content: "",
      editorOption: {
        modules: {
          toolbar: [
            [{ color: [] }, { background: [] }],
            ["bold", "italic", "underline"],
            [{ list: "ordered" }, { list: "bullet" }],
            ["link", "image", "video"],
            ["clean"],
          ],
          syntax: {
            highlight: (text) => hljs.highlightAuto(text).value,
          },
        },
      },
      formFields: {
        title: "",
        description: "",
        brand: "",
      },
      pricing: {
        price: "",
        compare_at_price: "",
        cost_per_item: "",
        margin: null,
        profit: null,
      },
      search: {
        page_title: "",
        search_engine_desc: "",
        url_handle: "",
      },
      inventory: {
        sku: "",
        barcode: "",
        quantity: "",
        track_quantity: false,
        out_of_stock: false,
        category: [],
      },
      shipping: {
        weight: "",
        physical_product: false,
      },
      variant_types: ["size", "weight", "color"],
      variants: {
        has_variants: false,
        is_active: 0,
        options: [
          {
            type: "",
            values: [],
          },
        ],
      },
      files: [],
      showUrlModal: false,
      media: {
        url: "",
      },
    };
  },
  computed: {
    calculateMargin() {
      this.formFields.margin = 0;
      return `$ ${0}`;
    },
    calculateProfit() {
      return `$ ${0}`;
    },
    formData() {
      return {
        ...this.formFields,
        description: this.$refs.description.$refs.editor.innerHTML,
        ...this.inventory,
        ...this.search,
        ...this.pricing,
        ...this.variants,
        ...this.shipping,
      };
    },
    editor() {
      return this.$refs.description?.quill;
    },
    editorContent() {
      return this.$refs.description.$refs.editor.innerHTML;
    },
    variantDetails() {
      return {
        ...this.variants,
        is_active: this.variants.has_variants ? 1 : 0,
      };
    },
  },
  methods: {
    showFormFields() {
      console.log(this.formData);
    },
    addOption(e) {
      this.variants.options.push({
        type: "",
        values: [],
        price: '',
        quantity: '',
        sku:''
      });
    },
    addVariantName(e) {
      let index = e.target.getAttribute('data-index');
      this.variants.options[index].name = e.target.value;
    },
    addVariantValue(e) {
      if(!e.target.value) return false;
      let index = e.target.getAttribute('data-index');
      this.variants.options[index].values.push(e.target.value);
      this.displayVariants();
    },
    addCategory() {
      this.inventory.category.push({
        type: "",
        value: "",
      });
    },
    handleFileDrop(e) {
      let droppedFiles = e.dataTransfer.files;
      if (!droppedFiles) return;
      [...droppedFiles].forEach((f) => {
        this.files.push(f);
      });
    },
    handleFileInput(e) {
      let files = e.target.files;
      files = e.target.files;
      if (!files) return;
      [...files].forEach((f) => {
        this.files.push(f);
      });
    },
    removeFile(fileKey) {
      this.files.splice(fileKey, 1);
    },
    onEditorChange(editor) {
      console.log(editor.editor);
      // console.log(this.$refs.description.$refs.editor.innerHTML);
    },
    onEditorBlur(editor) {
      // console.log("editor blur!", editor);
    },
    onEditorFocus(editor) {
      // console.log("editor focus!", editor);
    },
    onEditorReady(editor) {
      // console.log("editor ready!", editor);
    },
    showContent() {
      // console.log(this.editorContent);
    },
    upload() {
      // console.log(this.formData);
    },
    submit() {
      // this.sending = true
      this.v$.$validate()
      if(!this.v$.$error){
        this.$inertia.post("/products", this.formData);
      }
    },
    afterComplete(file) {
      // console.log(file);
    },
    expandMediaForm() {
      this.expandMedia = !this.expandMedia;
    },
    expandForm() {
      this.expand = !this.expand;
    },
    displayVariants() {
            
            let attributes = this.variants.options
            let total_count = 1;
            // return false

            // a loop can do this 
            if (attributes.length == 1) {
                total_count = attributes[0].values.length
            }else if(attributes.length == 2){
                total_count = attributes[0].values.length * attributes[1].values.length
            }else if(attributes.length == 3){
              total_count = attributes[0].values.length * attributes[1].values.length * attributes[2].values.length
            }

            let g = [];
            let a = 0;
            
            let base_attribute = attributes[0];

            // const gVal = (data, g) => {
            //   let c = g.length;
            //   if (data.values.indexOf(c)) return data.values[c]
            //   return '';
            // }

            let z = [];

            //initialize variables first

            for (let j = 0; j < total_count; j++) {
              z[j] = [];
            }

            let q = 0;

            //first phase
            let first_attribute = attributes.length == 1 ? 1 : total_count / attributes[0].values.length

            for (let i = 0; i < base_attribute.values.length; i++) {
              for (let k = 0; k < first_attribute; k++) {
                z[q].push(base_attribute.values[i])
                q++;
              }
            }

            if(attributes.length > 1) {
              let second_attributes = total_count / attributes[1].values.length
                q = 0;
                for (let k = 0; k < second_attributes; k++) {
                  for (let i = 0; i < attributes[1].values.length; i++) {
                    z[q].push(attributes[1].values[i])
                    q++;
                  }
                }
            }

            
            if(attributes.length == 3) {
              let third_attributes = total_count / attributes[2].values.length
              q = 0
              for (let k = 0; k < third_attributes; k++) {
                for (let i = 0; i < attributes[2].values.length; i++) {
                  z[q].push(attributes[2].values[i])
                  q++;
                }
              }
            }

            let variantList = [];

            for(let l=0; l<z.length; l++) {
                variantList.push({
                    name: z[l].join(', '),
                    price: '34',
                    quantity: 1,
                    sku: '123456'
                })
            }

           this.variantList = variantList;
        },
  },
  validations(){
    return{
      formFields: {
        title: {required:helpers.withMessage('This field cannot be empty', required)},
        description: {required:helpers.withMessage('This field cannot be empty', required)},
        brand: {required:helpers.withMessage('This field cannot be empty', required)},
      },
      
    }
  },
  setup() {
    const open = ref(false);
    return {
      statusStyles,
    };
  },
};
</script>
<style scoped>
@import "style.css";
.quill {
  display: flex;
  flex-direction: column;
}
</style>
<style src="@vueform/multiselect/themes/default.css"></style>

