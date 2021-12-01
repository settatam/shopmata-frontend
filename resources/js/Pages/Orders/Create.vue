<template>
  <app-layout>
    <div class="flex-1 flex flex-col  overflow-y-auto xl:overflow-hidden">
      <!-- Breadcrumb -->
      <nav aria-label="Breadcrumb" class="bg-white border-b border-blue-gray-200 xl:hidden">
        <div class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8">
          <inertia-link href="#" class=" -ml-1 inline-flex items-center space-x-3 text-sm font-medium text-gray-900">
            <ChevronLeftIcon
              class="h-5 w-5 text-blue-gray-400"
              aria-hidden="true"
            />
            <span>Add a new Order</span>
          </inertia-link>
        </div>
      </nav>

      <order-modal
        @close="toggleModal"
        @addOrder="addOrders"
        v-if="showModal"
        :filter="filterProduct"
      />

      <div class="flex-1 flex xl:overflow-hidden">
        <!-- Secondary sidebar -->

        <!-- Main content -->
        <div class="flex-1 max-h-screen xl:overflow-y-auto">
          <div class="max-w-3xl mx-5 mt-4 px- sm:px- lg:py- lg:px-">
            <h1 class="text-xl font-semibold mb-6 text-gray-900">
              New Order
            </h1>
          </div>
          
          <div class="pl-5 flex w-full">
              <div class="flex flex-col">
                <div class=" bg-white pl-8 pr-6 pt-9 w-175">
                  <div class="flex justify-between">
                    <p class="font-semibold text-lg">Order Details</p>
                    
                    <div class="flex justify-between font-semibold mb-2">
                      <a href="#" class="text-cyan-500 font-semibold mr-6" @click="openReserve=true" >Reserve Items</a>
                      <a href="#" class="text-cyan-500 font-semibold">Add Custom Item</a>
                    </div>
                  </div>
                  <div class="flex justify-between">
                    <div class="relative mt-4">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                          <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                            <svg fill="none" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                          </button>
                        </span>
                        <div class="min-w-0 flex-1">
                          <label for="search" class="sr-only">Search</label>
                          <input id="text3" type="text" placeholder="Search for products..." class="block pl-10 py-2 rounded-md border border-gray-300 text-gray-900 placeholder-gray-300 focus:outline-none w-111"/>
                        </div>
                      </div>
                    <button class="px-4 border border-gray-300 mt-4 rounded-md" @click="browseProduct">Browse Products</button>
                  </div>
                  <empty-product-modal v-if="openModal && products.length == 0"/>
                  <product-modal v-if="openModal && products.length > 0" :products="products" :production="production" :variantSelected="variantSelected" @emitClose="emitClose" />
                  <discount-modal v-if="openDiscount" @emitClose="emitClose"/>
                  <shipping-modal v-if="openShipping" :selected="selected" @emitClose="emitClose"/>
                  <taxes-modal v-if="openTaxes" @emitClose="emitClose"/>
                  <new-customer-modal v-if="openCustomer" @emitClose="emitClose"/>
                  <billing-modal v-if="openBilling" @emitClose="emitClose"/>
                  <address-modal v-if="openAddress" @emitClose="emitClose"/>
                  <tag-modal v-if="openTag" @emitClose="emitClose"/>
                  <mark-as-paid-modal v-if="openMarkAsPaid" @emitClose="emitClose"/>
                  <reserve-items-modal v-if="openReserve" @emitClose="emitClose"/>
                  <div>
                     <div class="-mr-6 -ml-8 border-b-2 my-5 border-gray-100"></div>
                    <div v-for="(variant,index) in variantSelected" :key="index" class="flex justify-between">
                      <img :src="variant.image" alt="" class="w-10 h-10">
                      <div class="mr-3">
                        <p class="text-cyan-700">3.1 Dolce & Gabanna</p>
                        <p>{{variant.color}}</p>
                        <div>{{variant.sku}}</div>
                      </div>
                      <div class="flex my-auto">
                        <p class="my-auto">${{variant.price}}</p>
                        <XIcon class="w-4 h-4 mx-5 my-auto"/>
                        <input type="text" class="w-9 h-9 mr-7 my-auto" v-model="qty">
                        <p class="my-auto">${{variant.price * qty}}</p>
                      </div>
                      <XIcon class="w-3 h-3 my-auto"/>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-5 bg-white gap-2 border-gray-200 pt-8">
                      <div class="col-span-1 md:col-span-3 md:mb-10">
                          <h4 class="block text-black mb-2 bg-transparent" >
                              Notes
                          </h4>
                          <textarea class="border-solid border rounded-md border-gray-300 text-4 h-40 py-4 px-6 placeholder-gray-400 focus:outline-none md:mr-2 mb-2 w-74" placeholder="Add a note..." v-model="note" autocomplete="none"/>
                      </div>
                      <div class="col-span-1 md:col-span-2">
                          <div class="grid grid-cols-2 mt-5 md:mt-10">
                              <div class="col-span-1 mb-6">
                                  <h4 class="block font-semibold mb-4 bg-transparent md:text-right text-cyan-500 cursor-pointer" @click="openDiscount=true">
                                      Add Discount
                                  </h4>
                                  <h4 class="block text-black font-semibold mb-4 bg-transparent md:text-right">
                                      Sub Total
                                  </h4>
                                  <h4 class="block font-semibold mb-4 bg-transparent md:text-right text-cyan-500 cursor-pointer" @click="openShipping=true">
                                      Add Shipping
                                  </h4>
                                  <h4 class="block font-semibold mb-4 bg-transparent md:text-right text-cyan-500 cursor-pointer" @click="openTaxes=true">
                                      Taxes
                                  </h4>
                                  <h4 class="block text-black font-semibold mb-4 text-lg bg-transparent md:text-right">
                                      Total
                                  </h4>
                              </div>
                                <div class="col-span-1 mb-6">
                                    <div class="border-b-2 border-black w-8 mt-3  ml-23"></div>
                                    <h4 class="block text-black font-semibold mt-7 bg-transparent md:text-right">
                                        $ 700
                                    </h4>
                                    <div class="border-b-2 border-black w-8 mt-6.5 mb-7 ml-23"></div>
                                    <h4 class="block text-black font-semibold mb-4 bg-transparent md:text-right">
                                        $900
                                    </h4>
                                    <h4 class="block text-black font-semibold text-lg mb-4 bg-transparent md:text-right">
                                        $80
                                    </h4>
                                </div>
                            </div>
                      </div>
                    </div>
                    <div class="-mr-6 -ml-8 border-b-2 border-gray-100"></div>
                    <div class="flex justify-between bg-white border-gray-200 pt-4">
                                <div class=" my-9">
                                    <h4 class="block font-semibold mb-2" >
                                        Email Invoice
                                    </h4>
                                </div>
                                <div class=" my-8">
                                    <button class="px-6 py-2.5 text-center border border-gray-300 cursor-pointer  rounded-md" @click="addAttr('email')">
                                        Email invoice
                                    </button>
                                </div>
                    </div>
                    <div class="-mr-6 -ml-8 border-b-2 border-gray-100"></div>
                    
                      <div class="flex flex-col mt-5">
                        <div class="flex justify-between">
                          <h2 class="font-semibold my-auto"> Accept Payment </h2>
                          <div>
                            <button class="px-6 py-2.5  text-center border border-gray-300 cursor-pointer  rounded-md">Mark as Pending</button>
                            <button class="px-6 py-2.5  text-center border border-gray-300 cursor-pointer  rounded-md ml-6">Pay with Credit Card</button>
                          </div>
                        </div>
                        <div class="flex justify-between mt-2">
                          <div></div>
                          <button class="px-6 py-2.5  text-center border border-gray-300 cursor-pointer  rounded-md mb-8" @click="this.openMarkAsPaid = true" >Mark as Paid</button>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="flex mt-6.5 justify-end mb-32">
                   <inertia-link href="/orders">
                  <button class="px-6 py-3 text-center border border-gray-400 cursor-pointer rounded-md">Cancel</button> </inertia-link>
                  <button class="px-6 py-3  text-center border border-gray-400 cursor-pointer bg-indigo-600 text-white  rounded-md ml-4">Save as Draft</button>
                </div>
              </div>
              <div class="flex flex-col ml-5">
              <div class=" bg-white pl-5 pr-7 pb-10 pt-6 mb-5 ">
                  <h2 class="font-semibold text-lg">Find or create a customer</h2>
                  <div class="relative mt-4">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                      <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                        <svg fill="none" stroke="#666666" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                      </button>
                    </span>
                    <div class="min-w-0 flex-1">
                      <label for="search" class="sr-only">Search</label>
                      <input id="text1" type="text" placeholder="Search for products..." class="block pl-10 py-2 rounded-md border border-gray-300  text-gray-900 placeholder-gray-300 focus:outline-none w-72"/>
                    </div>

                  </div>
                  <div class="flex mx-auto justify-center mt-5 cursor-pointer" @click="openCustomer=true">
                    <PlusIcon class="h-4 w-4 my-auto mr-3"/>
                    <p class="text-gray-400">Create a new customer</p>
                  </div>
              </div>
              <div class="bg-white pl-5 pr-7 pb-9 pt-6">
                <div class="flex justify-between mb-6">
                  <h2 class="font-semibold text-lg">Tags</h2>
                  <h2 class="text-cyan-700 font-semibold">View all tags</h2>
                </div>
                <label for="search" class="sr-only">Search</label>
                <input id="text" type="text" placeholder="Urgent, reviewed, wholesale" class="block pl-10 py-2 rounded-md border border-gray-300  text-gray-900 placeholder-gray-300 focus:outline-none w-72"/>
              </div>
            </div>
            </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import Nav from "../../Layouts/Nav";
import axios from "axios";
import EmptyProductModal from "../Orders/Components/EmptyProductModal.vue" 
import ProductModal from "../Orders/Components/ProductModal.vue" 
import ShippingModal from "./Components/ShippingModal.vue" 
import DiscountModal from "./Components/DiscountModal.vue" 
import TaxesModal from "./Components/TaxesModal.vue" 
import NewCustomerModal from "./Components/NewCustomerModal.vue" 
import BillingModal from "./Components/BillingModal.vue" 
import AddressModal from "./Components/AddressModal.vue" 
import TagModal from "./Components/TagModal.vue" 
import MarkAsPaidModal from "./Components/MarkAsPaidModal.vue" 
import ReserveItemsModal from "./Components/ReserveItemsModal.vue" 


import {
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { ChevronLeftIcon,XIcon,PlusIcon } from "@heroicons/vue/solid";
import hljs from "highlight.js";
import UploadIcon from "../../../assets/UploadIcon";
import AngleUpIcon from "../../../assets/AngleUpIcon";
import Multiselect from "@vueform/multiselect";
import Button from '../../Jetstream/Button.vue';
// import "vue-multiselect/dist/vue-multiselect.min.css";

const statusStyles = {
  success: "bg-green-100 text-green-800",
  processing: "bg-yellow-100 text-yellow-800",
  failed: "bg-gray-100 text-gray-800",
};
export default {
  props: {
    //products: Object,
    filters: Object,
    orders: Array
  },

  components: {
    Nav,
    AppLayout,
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    Multiselect,
    UploadIcon,
    AngleUpIcon,
    Button,
    // MediaUrlModal,
    EmptyProductModal,
    ProductModal,
    ChevronLeftIcon,
    XIcon,
    PlusIcon,
    DiscountModal,
    ShippingModal,
    TaxesModal,
    NewCustomerModal,
    BillingModal,
    AddressModal,
    TagModal,
    MarkAsPaidModal,
    ReserveItemsModal
  },

  data() {
    return {
      valueContent: '',
      openShipping: false,
      selected:'',
      openDiscount: false,
      openTaxes:false,
      openCustomer: false,
      openBilling:false,
      openAddress:false,
      openTag:false,
      openMarkAsPaid:false,
      openReserve:false,
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
      qty:"",
      formFields: {
        title: "",
        description: "",
        brand: "",
      },
      note:'',
      variantSelected:[],
      openModal : false,
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
      products:[
        {
              id : 1,
              image: "https://picsum.photos/200",
              description: "3.1 Dolce & Gabanna",
              variants:
                [
                  {
                    image: "https://picsum.photos/200",
                    id:1,
                    color:"Blue",
                    price: 100,
                    quantity:20,
                    sku:910
                  },
                  {
                    image: "https://picsum.photos/200",
                    id:2,
                    color:"Green",
                    price: 100,
                    quantity:20,
                    sku:930
                  },
                ],
              
            },
            {
              id : 2,
              image: "https://picsum.photos/200",
              description: "3.1 Dolce & Gabanna",
              variants:
                [
                  {
                    image: "https://picsum.photos/200",
                    id:3,
                    color:"Blue",
                    price: 100,
                    quantity:20,
                    sku: 78,
                  },
                  {
                    image: "https://picsum.photos/200",
                    id:4,
                    color:"Green",
                    price: 100,
                    quantity:20, 
                    sku:99,
              },
              ],
              
            },
            {
              id : 3,
              image: "https://picsum.photos/200",
              description: "3.1 Dolce & Gabanna",
              variants:
                [
                  {
                    image: "https://picsum.photos/200",
                    id:5,
                    color:"Blue",
                    price: 100,
                    quantity:20,
                    sku:22,
                  },
                  {
                    image: "https://picsum.photos/200",
                    id:6,
                    color:"Green",
                    price: 100,
                    quantity:20,
                    sku:26,
                  },
                ],
              
            },
            {
              id : 4,
              image: "https://picsum.photos/200",
              description: "3.1 Dolce & Gabanna",
              variants:
                [{
                      image: "https://picsum.photos/200",
                      id:7,
                      color:"Orange",
                      price: 100,
                      quantity:20,
                      sku:33,
                  },
                  {
                    image: "https://picsum.photos/200",
                    id:8,
                    color:"Green",
                    price: 100,
                    quantity:20, 
                    sku: 35
                  },
                ],   
            },
            {
              id : 5,
              image: "https://picsum.photos/200",
              description: "3.1 Dolce & Gabanna",
              variants:
                [
                  {
                    image: "https://picsum.photos/200",
                    id:9,
                    color:"Blue",
                    price: 100,
                    quantity:20,
                    sku:90
                  },
                  {
                    image: "https://picsum.photos/200",
                    id:10,
                    color:"Pink",
                    price: 100,
                    quantity:20,
                    sku:98
                  },
                ],
              
            },
            {
              id : 6,
              image: "https://picsum.photos/200",
              description: "3.1 Dolce & Gabanna",
              variants:{},
            },
            {
              id : 7,
              image: "https://picsum.photos/200",
              description: "3.1 Dolce & Gabanna",
              variants:{},
            },
            {
              id : 8,
              image: "https://picsum.photos/200",
              description: "3.1 Dolce & Gabanna",
              variants:
                [{
                    id:11,
                      color:"Black",
                      price: 100,
                      quantity:20,
                      sku:78,
                      image: "https://picsum.photos/200",
                    },
                  {
                    image: "https://picsum.photos/200",
                    id:12,
                    color:"Baige",
                    price: 100,
                    quantity:20,
                    sku:899,
                  },
                ],
              
            },
      ],
      production:[],
      subTotal: 0,
                taxes: 0,
                total: 0,
                email: false,
                pending: false,
                paid: false
    };
  },
  methods: {
    async getProducts() {
      this.toggleModal();
    },
    toggleModal() {
      this.showModal = !this.showModal;
    },
    addOrders(orders) {
      this.orders = [...this.orders, ...orders];
      this.toggleModal();
      this.runCalculations();
    },
    reducer(init, val) {
      return (
        (init + Number(val.compare_at_price)) * Number(val.quantityOrdered)
      );
    },
    changeQty(id) {
      const qty = this.$refs.editable[0].innerText;
      const regex = "^\\s+$";
      if (qty.match(regex) === null) {
        let orders = this.orders;
        const fIndex = orders.findIndex((x) => x.id == id);
        orders[fIndex] = { ...orders[fIndex], quantityOrdered: qty };
        this.orders = orders;
        this.runCalculations();
      }
    },
    runCalculations() {
      const total = this.orders.reduce(this.reducer, 0);
      this.total = total;
      this.subTotal = total;
    },
    addAttr(el) {
      this[el] = !this[el];
    },
    submit() {
      const data = {
        orders: this.orders,
        note: this.note,
        subTotal: this.subTotal,
        taxes: this.taxes,
        total: this.total,
        email: this.email,
        pending: this.pending,
        paid: this.paid,
      };
      this.$inertia.post("/orders/create", data);
    },
    displayVariants() {
            
            let attributes = this.variants
            let total_count = 1;

            // a loop can do this 
            if (attributes.indexOf(1) && attributes.indexOf(2)) {
              total_count = attributes[0].values.length * attributes[1].values.length * attributes[2].values.length
            }

            let g = [];
            let a = 0;
            
            let base_attribute = attributes[0];

            const gVal = (data, g) => {
              let c = g.length;
              if (data.values.indexOf(c)) return data.values[c]
              return '';
            }

            let z = [];

            //initialize variables first

            for (let j = 0; j < total_count; j++) {
              z[j] = [];
            }

            let q = 0;

            //first phase
            let first_attribute = total_count / attributes[0].values.length

            for (let i = 0; i < base_attribute.values.length; i++) {
              for (let k = 0; k < first_attribute; k++) {
                z[q].push(base_attribute.values[i])
                q++;
              }
            }

            let second_attributes = total_count / attributes[1].values.length
            q = 0;

            for (let k = 0; k < second_attributes; k++) {
              for (let i = 0; i < attributes[1].values.length; i++) {
                z[q].push(attributes[1].values[i])
                q++;
              }
            }

            let third_attributes = total_count / attributes[2].values.length

            q = 0
            for (let k = 0; k < third_attributes; k++) {
              for (let i = 0; i < attributes[2].values.length; i++) {
                z[q].push(attributes[2].values[i])
                q++;
              }
            }

            console.log(z)
        },
    emitClose() {
      //console.log("object")
      this.openModal = false
      this.openShipping= false
      this.openDiscount = false
      this.openTaxes = false
      this.openCustomer = false
      this.openBilling = false
      this.openAddress = false
      this.openTag = false
      this.openMarkAsPaid = false
      this.openReserve = false
    },
    async getProducts() {
            //this.loading = true
            const products = await axios.post('/products/get-order-products')
            this.production = products.data.data
            //this.loading = false
            console.log(products)
        },
      browseProduct(){
        this.openModal=true
        this.getProducts()
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
.purple-color {
  color: #923ea1;
}
.quill {
  display: flex;
  flex-direction: column;
}
</style>
<style src="@vueform/multiselect/themes/default.css"></style>

