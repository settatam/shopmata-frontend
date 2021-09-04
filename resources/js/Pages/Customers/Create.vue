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
            <span>Add a new Customer</span>
            <span>
              <button class="px-6 py-3 text-center border border-gray-400 cursor-pointer rounded-md">Cancel</button>
              <button class="px-6 py-3  text-center border border-gray-400 cursor-pointer bg-indigo-600 text-white  rounded-md ml-4">Save as Draft</button>
            </span>
          </inertia-link>
        </div>
      </nav>

      <div class="flex-1 flex xl:overflow-hidden">
        <!-- Secondary sidebar -->

        <!-- Main content -->
        <div class="flex-1 max-h-screen xl:overflow-y-auto">
          <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
            <h1 class="text-2xl font-extrabold text-blue-gray-900">
              Add New Customer
            </h1>
            <div class="bg-white pb-10 pt-1 mt-4">
              <personal-info-form :info="info"></personal-info-form>
              <div class="border-b border-gray-200"></div>
              <address-form
                :address="address"
                :countries="countries"
                @added="addTag"
              ></address-form>
              <!-- <div class="text-center bg-white pt-6 pb-6 mb-6">
                <t-button
                  class="
                    text-white
                    bg-purple-darker
                    active:bg-purple-darker
                    font-medium
                    border border-transparent
                    px-11
                    py-3.5
                    cursor-pointer
                  "
                  @click="submit"
                  >Add Customer</t-button
                >
              </div> -->
            </div>
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
// import Search from "../Search.vue";
import Nav from "../../Layouts/Nav";
// import axios from "axios";

import {
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";

import UploadIcon from "../../../assets/UploadIcon";
import AngleUpIcon from "../../../assets/AngleUpIcon";
import Multiselect from "@vueform/multiselect";
// import "vue-multiselect/dist/vue-multiselect.min.css";

// import CustomModal from '../../Components/CustomModal.vue'
import PersonalInfoForm from "./Components/PersonalInfoForm";
import AddressForm from "./Components/AddressForm";
// import SideNav from './../../Layouts/SideNav'

const statusStyles = {
  success: "bg-green-100 text-green-800",
  processing: "bg-yellow-100 text-yellow-800",
  failed: "bg-gray-100 text-gray-800",
};
export default {
  props: {
    countries: Array,
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
    PersonalInfoForm,
    AddressForm,
  },

  data() {
    return {
      formFields: {
        first_name: "",
        last_name: "",
        email: "",
        phone: "",
      },
      address: {
        first_name: "",
        last_name: "",
        state: null,
        city: null,
        postal_code: "",
        address: "",
        apartment: "",
        country: null,
      },
      info: {
        first_name: "",
        last_name: "",
        email: "",
        phone_number: "",
      },
      formFields_errors: {
        first_name: "",
        last_name: "",
        email: "",
        phone: "",
      },
      address_errors: {
        first_name: "",
        last_name: "",
        state: null,
        city: null,
        postal_code: "",
        address: "",
        apartment: "",
        country: null,
      },
      info_errors: {
        first_name: "",
        last_name: "",
        email: "",
        phone_number: "",
      },
    };
  },
  computed: {
    calculateMargin() {
      this.formFields.margin = 0;
      return `$ ${0}`;
    },
  },
  methods: {
    submit() {
      // console.log({...this.address, ...this.info});
      this.$inertia.post("/customers", {...this.address, ...this.info});
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

