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
                <!-- <div class="bg-white flex justify-between px-8 cursor-pointer" @click="expandForm">
                  <span><angle-up-icon></angle-up-icon></span>
                </div> -->
                <div class="bg-white px-8 pb-6 mb-6" v-if="expand">
                  <!-- <p class="text-black text-2xl font-semilbold mb-6">Update Product</p> -->
                  <div class="mb-10">
                    <label class="block text-sm font-bold text-gray-700" for="title">
                      Title
                    </label>
                    <div class="mt-1">
                        <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="product.title">
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
                        :value="product.description"
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
                      v-model="product.brand"
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
                  <div class="bg-white flex justify-between">
                    <p class="text-black font-semibold text-lg mb-6">Medias</p>
                  </div>
                  <div>
                    <images-list :images="product.images" v-if="product.images.length"></images-list>
                    <Dropzone
                    @add-image="onAddImage"
                    ></Dropzone>
                  </div>
                </div>
              </div>

              <!-- Princing Start here -->

            <div class="bg-white pt-7 pb-1 mb-10">
                <div class="flex justify-between px-8 cursor-pointer" @click="expandForm">
                    <p class="text-black font-semibold text-lg mb-6">Pricing</p>
                    <span><angle-up-icon></angle-up-icon></span>
                </div>
                <div class="px-8">
                    <div class="mb-5 md:mb-10">
                        <div class="flex flex-wrap mb-6">
                            <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                      {{ store.currency.symbol_left }}
                                    </span>
                                  </div>
                                  <input type="text" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency" v-model="product.price"/>
                                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm" id="price-currency">
                                      {{ store.currency.code }}
                                    </span>
                                  </div>
                                </div>
                            </div> 

                            <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                                <label for="price" class="block text-sm font-medium text-gray-700">Compare at price</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                      {{ store.currency.symbol_left }}
                                    </span>
                                  </div>
                                  <input type="text" name="compare_at_price" id="compare_at_price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency" v-model="product.compare_at_price"/>
                                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm" id="price-currency">
                                      {{ store.currency.code }}
                                    </span>
                                  </div>
                                </div>
                            </div>               
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                            <label class="block text-black font-semibold mb-2 bg-transparent" for="cost_per_item">
                                Cost per item
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                      {{ store.currency.symbol_left }}
                                    </span>
                                  </div>
                                  <input type="text" name="compare_at_price" id="cost_per_item" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="cost_per_item" v-model="product.cost_per_item"/>
                                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm" id="price-currency">
                                      {{ store.currency.code }}
                                    </span>
                                  </div>
                              </div>
                            <p class="text-gray-300 font-semibold flex items-center text-xs mt-2">
                            <warning-icon></warning-icon><span class="mx-1">Customers won't see this</span></p>
                        </div>
                        <div class="w-full md:w-1/2 md:pl-3 mb-6 md:mb-0 flex flex-wrap">
                            <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                                <label class="block text-black font-semibold mb-2 bg-transparent" >
                                    Margin
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                      {{ store.currency.symbol_left }}
                                    </span>
                                  </div>
                                  <input type="text" name="compare_at_price" id="compare_at_price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency" v-model="product.margin"/>
                                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm" id="price-currency">
                                      {{ store.currency.code }}
                                    </span>
                                  </div>
                              </div>
                            </div>
                            <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                                <label class="block text-black font-semibold mb-2 bg-transparent" >
                                    Profit
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">
                                      {{ store.currency.symbol_left }}
                                    </span>
                                  </div>
                                  <input type="text" name="compare_at_price" id="compare_at_price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="cost_per_item" v-model="product.profit"/>
                                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm" id="price-currency">
                                      {{ store.currency.code }}
                                    </span>
                                  </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none" id="charge_tax">
                            <label for="charge_tax" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                                Charge tax on this product
                            </label>
                        </div>
                    </div>
                  </div>
              </div>

              <!-- Inventory Starts here -->

              <div class="bg-white pt-7 pb-1 mb-10">
                  <div class="flex justify-between px-8 cursor-pointer">
                      <p class="text-black font-semibold text-lg mb-6">Inventory</p>
                  </div>
                  <div v-if="expand" class="px-8">
                      <div class="mb-8">
                          <div class="flex flex-wrap mb-6">
                              <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                                  <label class="block text-black font-semibold mb-2 bg-transparent" for="page-title">
                                      SKU(Stock Keeping Unit)
                                  </label>
                                  <div class="mt-1 relative rounded-md shadow-sm">
                                      <input type="text" name="sku" id="sku" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="product sku" v-model="product.sku"/>
                                  </div>
                              </div>
                              <div class="w-full md:w-1/2 mb-6 md:mb-0 md:pl-3">
                                  <label class="block text-black font-semibold mb-2 bg-transparent" for="page-title">
                                      Barcode (ISBN, UPC, GTIN, etc)
                                  </label>
                                  <div class="mt-1 relative rounded-md shadow-sm">
                                      <input type="text" name="barcode" id="barcode" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" aria-describedby="product barcode" v-model="product.barcode"/>
                                  </div>
                              </div>
                              <div class="mt-8 mb-6">
                                  <div class="flex items-center">
                                      <input v-model="product.track_quantity" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none" id="track_quantity">
                                      <label for="track_quantity" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                                          Track Quantity
                                      </label>
                                  </div>
                                  <div class="flex items-center mt-4">
                                      <input v-model="product.out_of_stock" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none" id="out_of_stock">
                                      <label for="out_of_stock" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                                          Continue selling when out of stock
                                      </label>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <p class="text-gray-700 font-semibold text-lg mb-6">Quantity</p>
                      <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                              <label class="block text-gray-700 font-semibold mb-2 bg-transparent" for="page-title">
                                  Available
                              </label>
                              <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none" type="number" placeholder="0" v-model="product.quantity">
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Inventory Ends here -->

              <!-- Shipping starts here -->
              
              <div class="bg-white pt-7 pb-1 mb-10 px-8">
                  <div class="flex justify-between cursor-pointer">
                      <p class="text-black font-semibold text-lg mb-6">Shipping</p>
                      <span><angle-up-icon></angle-up-icon></span>
                  </div>
                  <div class="flex flex-wrap mb-6">
                      <div class="mb-6">
                          <div class="flex items-center">
                              <input v-model="product.physical_product" type="checkbox" id="physical_product" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none">
                              <label for="physical_product" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                                  This is a physical product
                              </label>
                          </div>
                      </div>
                  </div>
                  <p class="text-black font-semibold text-lg mb-3">Weight</p>
                  <p class="text-gray-600 pb-4">Used to calculate shipping rates at checkout and label prices during fulfillment.</p>
                  <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full md:w-4/5 px-3 mb-6 md:mb-0">
                          <label class="block text-black font-semibold mb-2 bg-transparent" for="weight">
                              Weight
                          </label>
                          <div class="mt-1 relative rounded-md shadow-sm">
                              <input type="text" name="compare_at_price" id="compare_at_price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency" v-model="product.weight"/>
                                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm" id="price-currency">
                                      {{ store.weight !== null ? store.weight.unit : '' }}
                                    </span>
                                  </div>
                              </div>
                      </div>
                  </div>
              </div>

              <!-- Shipping ends here -->
            
              <variants-form
                :variants="variants"
                :types="variant_types"
                :valueContent="valueContent"
                :variantList="variantList"
                @added="addOption"
                @add-variant-name="addVariantName"
                @added-variant-value="addVariantValue"
              ></variants-form>

              <!-- Search Engine Starts Here -->
              <div class="bg-white pt-7 pb-1 mb-10 px-8">
                  <div class="flex justify-between">
                      <div class="cursor-pointer" @click="expandForm">
                          <p class="text-black font-semibold text-lg mb-6">Search engine listing preview</p>
                          <p class="text-black text-sm mb-6">Add a title and description to see how this product might appear in a search engine listing</p>
                      </div>     
                  </div>
                  <div class="my-6">
                      <label class="block text-black mb-2 bg-transparent" for="page-title">
                          Page title
                      </label>
                      <input class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" type="text" placeholder="Short sleeve t-shirt" v-model="product.seo_page_title">
                      <p class="text-gray-600">{{pageTitleLength}} of 70 characters used</p>
                  </div>
                  <div class="mb-6">
                      <label class="block text-black mb-2 bg-transparent" for="search_engine_desc">
                          Description
                      </label>
                      <textarea name="w3review" rows="6" cols="50" class="block w-full shadow-sm py-3 px-4 placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 border border-gray-300 rounded-md" placeholder="" v-model="product.seo_description"/>
                      <p class="text-gray-600">{{searchEngDescLength}} of 320 characters used</p>
                  </div>
                  <div class="mb-6">
                      <label class="block text-black mb-2 bg-transparent" for="url_handle">
                          URL and handle
                      </label>
                      <div class="mt-1 relative rounded-md shadow-sm">
                          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <span class="text-gray-500 sm:text-sm" ref="domain_name">
                                  {{ store.domains[0].name}}/
                              </span>
                          </div>
                          <input type="text" :style="{paddingLeft: domainWidth}" name="handle" id="handle" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" aria-describedby="price-currency" v-model="product.handle"/>
                      </div>
                  </div>
              </div>
              <!-- Search Engine Ends here -->
              
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
import MediaUrlModal from "./Components/MediaUrlModal";
import Dropzone from "./Components/Dropzone";
import ImagesList from "./Components/ImagesList";
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
    store: Object
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
    UploadIcon,
    AngleUpIcon,
    MediaUrlModal,
    Dropzone,
    ImagesList
  },

  data() {
    return {
      valueContent: '',
      variantList: [],
      expand: true,
      expandMedia: true,
      content: "",
      pageTitleLength: 0,
      searchEngDescLength: 0,
      domainWidth: '0',
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
      product: {
        title: "",
        description: "",
        brand: "",
        images: [],
        price: '',
        compare_at_price: '',
        margin: null,
        profit: null,
        cost_per_item: '',
        handle:'',
        sku: "",
        barcode: "",
        quantity: "",
        track_quantity: false,
        out_of_stock: false,
        has_variants: false,
      },
      shipping: {
        weight: "",
        physical_product: false,
      },
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
    activeDomain() {

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
  mounted() {
    this.domainWidth = this.$refs.domain_name.clientWidth+8+'px'
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
    onAddImage(response) {
      for(let i=0; i<response.data.length; i++) {
        this.product.images.push(response.data[i]);
      }
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
      this.product.description = this.$refs.description.$refs.editor.innerHTML;
      this.product.variants = this.variantList;
      this.product.variant_options = this.variants.options
      console.log(this.product);
      axios.post('/products', this.product);

      // this.$inertia.post("/products", this.formData);
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
                    price: '',
                    quantity: 1,
                    sku: ''
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

