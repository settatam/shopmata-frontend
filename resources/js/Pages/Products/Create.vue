<template>
  <app-layout>
    <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
      <!-- Breadcrumb -->
      <nav
        aria-label="Breadcrumb"
        class="bg-white border-b border-blue-gray-200 xl:hidden"
      >
        <div
          class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8"
        >
          <inertia-link href="#" class="ml-1 inline-flex items-center space-x-3 text-sm font-medium text-blue-gray-900">
            <ChevronLeftIcon class="h-5 w-5 text-blue-gray-400" aria-hidden="true"/>
            <span>Add a new Product</span>
          </inertia-link>
        </div>
      </nav>

      <div class="flex-1 flex xl:overflow-hidden">
        <!-- Secondary sidebar -->
        <Nav page="General"></Nav>
        <!-- Main content -->
        <div class="flex-1 max-h-screen xl:overflow-y-auto">
          <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
            <h1 class="text-2xl font-extrabold text-blue-gray-900">
              Add New Product
            </h1>
            <form @submit.prevent="submit">
              <div class="bg-white mb-10 pt-7">
                <div class="bg-white flex justify-between px-8 cursor-pointer" @click="expandForm">
                  <span><angle-up-icon></angle-up-icon></span>
                </div>
                <div class="bg-white px-8 pb-6 mb-6" v-if="expand">
                  <!-- <p class="text-black text-2xl font-semilbold mb-6">Update Product</p> -->
                  <div class="mb-10">
                    <label class="block text-sm font-bold text-gray-700" for="title">
                      Title
                    </label>
                    <div class="mt-1">
                        <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="formFields.title">
                    </div>
                  </div>

                  <div class="mb-6">
                    <label
                      class="block text-black font-semibold mb-2 bg-transparent"
                      for="description"
                    >
                      Description
                    </label>
                    <div class="quill">
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
                    </div>
                  </div>
                  <div class="mt-20">
                    <label class="block text-black font-semibold mb-2 bg-transparent" for="brand">
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
              <div class="text-center bg-white pt-6 pb-6 mb-6">
                <t-button class="text-white bg-purple-darker active:bg-purple-darker font-medium border border-transparent px-11 py-3.5 cursor-pointer" @click="submit">Add Product</t-button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
// import Search from "../Search.vue";
import Nav from "./Components/Nav";
import axios from "axios";

import {
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { ChevronLeftIcon } from "@heroicons/vue/solid";
import hljs from "highlight.js";
import InventoryForm from "./Components/InventoryForm";
import ShippingForm from "./Components/ShippingForm";
import VariantsForm from "./Components/VariantsForm";
import SearchEngineForm from "./Components/SearchEngineForm";
import MediaUrlModal from "./Components/MediaUrlModal";
import PricingForm from "./Components/PricingForm";
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
    ShippingForm,
    VariantsForm,
    SearchEngineForm,
    PricingForm,
    UploadIcon,
    AngleUpIcon,
    MediaUrlModal,
    Dropzone
  },

  data() {
    return {
      valueContent: '',
      variantList: [],
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

      this.$inertia.post("/products", this.formData);
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

