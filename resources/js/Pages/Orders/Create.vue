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
          <inertia-link
            href="#"
            class="
              -ml-1
              inline-flex
              items-center
              space-x-3
              text-sm
              font-medium
              text-blue-gray-900
            "
          >
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
          <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
            <h1 class="text-2xl font-extrabold text-blue-gray-900">
              Add New Order
            </h1>

            <!-- Order starts here -->
            <div class="bg-white mb-10 pt-7">
              <div class="grid grid-cols-5 bg-white md:px-8 px-4 gap-2">
                <div class="col-span-3 mb-2">
                  <h4
                    class="
                      block
                      text-black
                      md:text-lg
                      md:font-bold
                      mb-2
                      bg-transparent
                    "
                  >
                    Order Details
                  </h4>
                </div>
                <div class="col-span-2 mb-2">
                  <h4
                    class="
                      block
                      text-black
                      md:text-lg
                      mb-2
                      bg-transparent
                      text-right
                    "
                  >
                    Add Custom Item
                  </h4>
                </div>
              </div>

              <div
                class="
                  grid grid-cols-1
                  md:grid-cols-5
                  bg-white
                  md:px-8
                  px-4
                  gap-2
                  mb-10
                "
              >
                <div class="col-span-1 md:col-span-3">
                  <input
                    class="
                      search-bar
                      border-solid border border-gray-400
                      text-4
                      py-2
                      pl-10
                      pr-2
                      placeholder-gray-400
                      focus:outline-none
                      md:mr-2
                      mb-2
                      w-full
                    "
                    @blur="getProducts"
                    placeholder="Search Products"
                    v-model="filterProduct"
                    autocomplete="none"
                  />
                </div>
                <div class="col-span-1 md:col-span-2 flex justify-end">
                  <div
                    class="
                      md:flex-none
                      w-1/2
                      md:w-full
                      px-2
                      py-2
                      text-center
                      border border-gray-400
                      cursor-pointer
                    "
                    @click="toggleModal"
                  >
                    Browse Products
                  </div>
                </div>
              </div>

              <div
                class="bg-white md:px-8 px-4 border-t-2 border-gray-200 py-4"
                v-if="orders.length !== 0"
              >
                <div
                  class="grid grid-cols-12 gap-2 py-2"
                  v-for="product in orders"
                  :key="product.id"
                >
                  <div class="col-span-4 md:col-span-1 cursor-pointer py-2">
                    <img
                      :src="product.images[0].image_url || ''"
                      class="w-12 h-12 bg-gray-300"
                    />
                  </div>
                  <div class="col-span-8 md:col-span-5 px-2">
                    <div class="purple-color">
                      {{ product.title }}
                    </div>
                    <div class="text-gray-400">
                      {{ product.brand ? product.brand.name : "" }} <br />
                      SKU: {{ product.sku }}
                    </div>
                  </div>
                  <div
                    class="col-span-10 md:col-span-5 text-center mt-4 sm:mt-0"
                  >
                    ${{ product.compare_at_price }} X
                    <span
                      class="px-2 py-2 border mx-2"
                      ref="editable"
                      contenteditable
                      @input="changeQty(product.id)"
                    >
                      {{ product.quantityOrdered }}
                    </span>
                    ${{ product.compare_at_price }}
                  </div>
                  <div
                    class="col-span-2 md:col-span-1 text-center mt-4 sm:mt-0"
                  >
                    X
                  </div>
                </div>
              </div>

              <div
                class="
                  grid grid-cols-1
                  md:grid-cols-2 md:grid-cols-5
                  bg-white
                  md:px-8
                  px-4
                  gap-2
                  border-t-2 border-gray-200
                  pt-4
                "
              >
                <div class="col-span-1 md:col-span-3 md:mb-10">
                  <h4
                    class="
                      block
                      text-black text-lg
                      font-bold
                      mb-2
                      bg-transparent
                    "
                  >
                    Notes
                  </h4>
                  <input
                    class="
                      border-solid border border-gray-400
                      text-4
                      py-2
                      pl-10
                      pr-2
                      placeholder-gray-400
                      focus:outline-none
                      md:mr-2
                      mb-2
                      w-full
                    "
                    placeholder="Add a note..."
                    v-model="note"
                    autocomplete="none"
                  />
                </div>
                <div class="col-span-1 md:col-span-2">
                  <div class="grid grid-cols-2 mt-5 md:mt-10">
                    <div class="col-span-1 mb-6">
                      <h4
                        class="
                          block
                          font-bold
                          mb-4
                          bg-transparent
                          md:text-right
                          purple-color
                        "
                      >
                        Add Discount
                      </h4>
                      <h4
                        class="
                          block
                          text-black
                          font-bold
                          mb-4
                          bg-transparent
                          md:text-right
                        "
                      >
                        Sub Total
                      </h4>
                      <h4
                        class="
                          block
                          font-bold
                          mb-4
                          bg-transparent
                          md:text-right
                          purple-color
                        "
                      >
                        Add Shipping
                      </h4>
                      <h4
                        class="
                          block
                          font-bold
                          mb-4
                          bg-transparent
                          md:text-right
                          purple-color
                        "
                      >
                        Taxes
                      </h4>
                      <h4
                        class="
                          block
                          text-black
                          font-extrabold
                          mb-4
                          bg-transparent
                          md:text-right
                        "
                      >
                        Total
                      </h4>
                    </div>
                    <div class="col-span-1 mb-6">
                      <h4
                        class="
                          block
                          text-black text-lg
                          mb-4
                          bg-transparent
                          md:text-right
                        "
                      >
                        ----------
                      </h4>
                      <h4
                        class="
                          block
                          text-black
                          font-bold
                          mb-4
                          bg-transparent
                          md:text-right
                        "
                      >
                        ${{ subTotal.toFixed(2) }}
                      </h4>
                      <h4
                        class="
                          block
                          text-black
                          font-bold
                          mb-4
                          bg-transparent
                          md:text-right
                        "
                      >
                        -----------
                      </h4>
                      <h4
                        class="
                          block
                          text-black
                          font-bold
                          mb-4
                          bg-transparent
                          md:text-right
                        "
                      >
                        ${{ taxes.toFixed(2) }}
                      </h4>
                      <h4
                        class="
                          block
                          text-black
                          font-extrabold
                          mb-4
                          bg-transparent
                          md:text-right
                        "
                      >
                        ${{ total.toFixed(2) }}
                      </h4>
                    </div>
                  </div>
                </div>
              </div>

              <div
                class="
                  grid grid-cols-6
                  bg-white
                  md:px-8
                  px-4
                  gap-2
                  border-t-2 border-gray-200
                  pt-4
                "
              >
                <div class="col-span-3 md:col-span-4 mb-10">
                  <h4
                    class="
                      block
                      text-black
                      md:text-lg
                      md:font-bold
                      mb-2
                      bg-transparent
                    "
                  >
                    Email Invoice
                  </h4>
                </div>
                <div class="col-span-3 md:col-span-2 mb-6">
                  <div
                    class="
                      px-2
                      py-2
                      text-center
                      border border-gray-400
                      cursor-pointer
                    "
                    @click="addAttr('email')"
                  >
                    Email invoice
                    <i class="fas fa-check purple-color" v-if="email"></i>
                  </div>
                </div>
              </div>

              <div
                class="
                  grid grid-cols-6
                  bg-white
                  md:px-8
                  px-4
                  gap-2
                  border-t-2 border-gray-200
                  pt-4
                  pb-4
                "
              >
                <div class="col-span-2 mb-10">
                  <h4
                    class="
                      block
                      text-black
                      md:text-lg
                      md:font-bold
                      mb-2
                      bg-transparent
                    "
                  >
                    Accept Payment
                  </h4>
                </div>
                <div class="col-span-4">
                  <div class="grid grid-cols-2 md:grid-cols-4 md:mb-6">
                    <div class="col-span-2 md:px-2 mb-2">
                      <div
                        class="
                          px-2
                          py-2
                          text-center
                          border border-gray-400
                          cursor-pointer
                        "
                        @click="addAttr('paid')"
                      >
                        Mark as Pending
                        <i class="fas fa-check purple-color" v-if="!paid"></i>
                      </div>
                    </div>
                    <div class="col-span-2">
                      <div
                        class="
                          px-2
                          py-2
                          text-center
                          border border-gray-400
                          cursor-pointer
                          mb-2
                        "
                      >
                        Pay with credit Card
                      </div>
                      <div
                        class="
                          px-2
                          py-2
                          text-center
                          border border-gray-400
                          cursor-pointer
                        "
                        @click="addAttr('paid')"
                      >
                        Mark as Paid
                        <i class="fas fa-check purple-color" v-if="paid"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <Nav page="General"></Nav>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import Nav from "../../Layouts/Nav";
import axios from "axios";
import OrderModal from "./Components/OrderModal";

import {
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";

import hljs from "highlight.js";
import UploadIcon from "../../../assets/UploadIcon";
import AngleUpIcon from "../../../assets/AngleUpIcon";
import Multiselect from "@vueform/multiselect";

const statusStyles = {
  success: "bg-green-100 text-green-800",
  processing: "bg-yellow-100 text-yellow-800",
  failed: "bg-gray-100 text-gray-800",
};
export default {
  props: ["categories", "brands", "notification"],

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
    OrderModal,
  },

  data() {
    return {
      formFields: {
        title: "",
        description: "",
        brand: "",
      },
      filterProduct: "",
      note: "",
      searchCustomers: "",
      searchTags: "",
      image: "",
      orders: [],
      showModal: false,
      subTotal: 0,
      taxes: 0,
      total: 0,
      email: false,
      pending: false,
      paid: false,
    };
  },
  methods: {
    submit() {},
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

