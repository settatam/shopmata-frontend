<template>
    <app-layout>
        <div class="flex-1 flex flex-col mt-4 min-h-screen">
            <div class="flex-shrink-0 px-8 py-4 flex items-center">
                <p class="text-2xl font-semibold text-blue-gray-900">Orders</p>
            </div>
            <nav class="flex px-8 mb-4" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a
                                href="/dashboard"
                                class="text-gray-400 hover:text-gray-500"
                            >
                                <HomeIcon
                                    class="flex-shrink-0 h-5 w-5"
                                    aria-hidden="true"
                                />
                                <span class="sr-only">Orders</span>
                            </a>
                        </div>
                    </li>
                    <li v-for="page in pages" :key="page.name">
                        <div class="flex items-center">
                            <ChevronRightIcon
                                class="flex-shrink-0 h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                            <a
                                :href="page.href"
                                class="
                                    ml-4
                                    text-sm
                                    font-medium
                                    text-gray-500
                                    hover:text-gray-700
                                "
                                :aria-current="
                                    page.current ? 'page' : undefined
                                "
                                >{{ page.name }}</a
                            >
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="px-6 flex w-full">
                <div class="flex flex-col w-2/3 mr-5">
                    <div class="bg-white py-6 px-8">
                            <div class="flex justify-between mb-3.5">
                                <h2 class="font-semibold text-xl">
                                    Orders placed
                                </h2>
                                <button
                                    class="
                                        px-8
                                        py-2
                                        text-center
                                        bg-gray-100
                                        border
                                        text-black
                                        rounded-md
                                    "
                                    @click="browseProduct"
                                >
                                    Send Invoice
                                </button>
                            </div>
                            <div class="flex justify-between">
                                <h2
                                    class="
                                        font-semibold
                                        text-xl text-indigo-700
                                    "
                                >
                                    Order #{{ order.id }}
                                </h2>
                                <p class="text-gray-400">
                                    {{ order.created_at }}
                                </p>
                            </div>
                            <p class="mt-2.5 text-base">
                                ${{ order.total }} from Online Store
                            </p>
                            <!-- <div class="flex mt-3.5">
                                <p class="mt-2.5">Status</p>
                                <select
                                    class="
                                        shadow-sm
                                        focus:ring-indigo-500
                                        focus:border-indigo-500
                                        block
                                        w-1/5
                                        ml-4
                                        sm:text-sm
                                        border-gray-300
                                        rounded-md
                                    "
                                    placeholder=""
                                    required
                                >
                                    <option value="fulfilled">Fulfilled</option>
                                    <option value="unfulfilled" selected>
                                        Unfulfilled
                                    </option>
                                </select>
                            </div> -->
                            <!-- <div
                                class="
                                    mt-2.5
                                    text-sm
                                    inline-flex
                                    leading-5
                                    bg-red-100
                                    text-red-500
                                    px-3.5
                                    py-2.5
                                "
                            >
                               {{ order.status }}
                            </div> -->
                            <div class=" mt-10 flex justify-between mr-10">
                                <div class="flex">
                                  <img
                                    src="../../../assets/placeholder_theme.jpg"
                                    alt="category_image"
                                    class="w-10 h-10"
                                  />
                                  <div class="ml-3">
                                    <h2 class="text-cyan-700 text-base mb-1">
                                        {{ order.description }}
                                    </h2>
                                    <p class="text-base text-gray-500">{{ order.item_name }}</p>
                                    <p class="text-base text-gray-500">Qty: {{ order.quantity }}</p>
                                    <p class="text-base text-gray-500">SKU: {{ order.sku }}</p>
                                  </div>
                                </div>
                                <div>
                                  <p class=" text-sm mb-1">Promotion</p>
                                  <p class=" font-semibold text-lg">{{ order.promotion }}</p>
                                </div>
                                <div>
                                  <p class="text-sm mb-1">Product Price</p>
                                  <p class=" font-semibold text-lg">{{ order.price }}</p>
                                </div>
                                <div>
                                  <p class="text-sm mb-1">Shipping</p>
                                  <p class=" font-semibold text-lg">{{ order.shipping_cost }}</p>
                                </div>
                                <div>
                                  <p class="text-sm mb-1">Total Amount</p>
                                  <p class=" font-semibold text-lg">{{ order.total }}</p>
                                </div>
                            </div>
                        </div>

                    <div class="bg-white pt-8 px-8 mt-6">
                        <div class="mb-4">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm mb-3">Data Added</p>
                                    <p class="font-semibold text-lg">{{ order.created_at }}</p>
                                </div>
                                <div>
                                    <p class="text-sm mb-3">Status</p>
                                    <div
                                        class="
                                            text-sm
                                            bg-green-100
                                            text-green-500
                                            w-full
                                            pl-8
                                            pr-8
                                            py-1.5
                                        "
                                    >
                                        {{ order.status }}
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm mb-3">Customer Note</p>
                                    <p v-if="order.customer_note" class="font-semibold text-lg">{{ order.created_at }}</p>
                                    <p v-else class="w-2 font-semibold text-gray-900">-</p>
                                </div>
                                <div>
                                    <p class="text-sm mb-3">Customer Notified</p>
                                    <p class="font-semibold text-lg">{{ order.customer_notified }}</p>
                                </div>
                            </div>
                            <!-- <h2 class="font-semibold text-xl mb-2.5">
                                {{ getCustomer.first_name }}
                                {{ getCustomer.last_name }}
                            </h2> -->
                            <div class="text-gray-400">
                                <!-- <h2 class="font-normal">
                                    {{ getCustomer.address }},
                                    {{ getCustomer.city }}
                                    {{ getCustomer.state }},
                                    {{ getCustomer.country }}
                                </h2> -->
                                <!-- <h2>Customer for about 4 years</h2> -->
                            </div>
                        </div>
                        <div class="mt-3.5 border-t border-gray-200 -mx-6">
                        </div>
                            <div class="mt-5">
                                <h2 class="font-semibold text-xl mb-5">
                                    Order History
                                </h2>
                                <div class="flex mb-8 justify-evenly">
                                    <div class="flex items-center w-1/5">
                                        <h2 class="font-normal text-base">Order Status</h2>
                                    </div>
                                    <div class="w-full ml-5">
                                        <select
                                        class="
                                            shadow-sm
                                            focus:ring-indigo-500
                                            focus:border-indigo-500
                                            w-full
                                            sm:text-sm
                                            border-gray-300
                                            rounded-md
                                        "
                                        placeholder=""
                                        required
                                    >
                                        <option value="fulfilled">Fulfilled</option>
                                        <option value="unfulfilled" selected>
                                            Unfulfilled
                                        </option>
                                    </select>
                                    </div>
                                </div>
                                <div class="mb-5 flex">
                                    <p class="mr-10 font-normal text-base">Notify Customer</p>
                                    <div class="flex items-center">
                                        <input type="checkbox" class="focus:ring-indigo-500 text-indigo-600 border-gray-300 mr-2" />
                                    </div>
                                </div>
                            </div>
                        <div class="flex mb-2">
                            <h2 class="font-normal text-sm">Customer Note</h2>
                        </div>
                        <div class="flex w-full mb-6">
                            <div class="w-full mr-2">
                                <input
                                    id="text3"
                                    type="text"
                                    placeholder="Add a note"
                                    class="
                                        w-full
                                        pl-4
                                        py-2
                                        rounded-md
                                        border border-gray-300
                                        text-gray-900
                                        placeholder-gray-300
                                        focus:outline-none
                                    "
                                />
                            </div>
                            <button
                                class="
                                    px-8
                                    py-2
                                    text-center
                                    bg-indigo-700
                                    border
                                    text-white
                                    rounded-md
                                "
                                @click="browseProduct"
                            >
                                Add
                            </button>
                        </div>
                        <empty-product-modal
                            v-if="openModal && products.length == 0"
                        />
                        <product-modal
                            v-if="openModal && products.length > 0"
                            :products="products"
                            :production="production"
                            :variantSelected="variantSelected"
                            @emitClose="emitClose"
                        />
                        <discount-modal
                            v-if="openDiscount"
                            @emitClose="emitClose"
                        />
                        <shipping-modal
                            v-if="openShipping"
                            :selected="selected"
                            @emitClose="emitClose"
                        />
                        <taxes-modal v-if="openTaxes" @emitClose="emitClose" />
                        <new-customer-modal
                            v-if="openCustomer"
                            @emitClose="emitClose"
                        />
                        <billing-modal
                            v-if="openBilling"
                            @emitClose="emitClose"
                        />
                        <address-modal
                            v-if="openAddress"
                            @emitClose="emitClose"
                        />
                        <tag-modal v-if="openTag" @emitClose="emitClose" />
                        <mark-as-paid-modal
                            v-if="openMarkAsPaid"
                            @emitClose="emitClose"
                        />
                        <reserve-items-modal
                            v-if="openReserve"
                            @emitClose="emitClose"
                        />
                        <div>
                            <div
                                class="
                                    -mr-6
                                    -ml-8
                                    border-b-2
                                    my-5
                                    border-gray-100
                                "
                            ></div>
                            <div
                                v-for="(variant, index) in variantSelected"
                                :key="index"
                                class="flex justify-between"
                            >
                                <img
                                    :src="variant.image"
                                    alt=""
                                    class="w-10 h-10"
                                />
                                <div class="mr-3">
                                    <p class="text-cyan-700">
                                        3.1 Dolce & Gabanna 
                                    </p>
                                    <p>{{ variant.color }}</p>
                                    <div>{{ variant.sku }}</div>
                                </div>
                                <div class="flex my-auto">
                                    <p class="my-auto">${{ variant.price }}</p>
                                    <XIcon class="w-4 h-4 mx-5 my-auto" />
                                    <input
                                        type="text"
                                        class="w-9 h-9 mr-7 my-auto"
                                        v-model="qty"
                                    />
                                    <p class="my-auto">
                                        ${{ variant.price * qty }}
                                    </p>
                                </div>
                                <XIcon class="w-3 h-3 my-auto" />
                            </div>
                            <div class="mb-8 lg:w-7/10 flex justify-between">
                                <div class="">
                                    <h4 class="mb-3">Last Order</h4>
                                    <h4 class="mb-3 font-semibold text-lg">
                                        {{ order.created_at }}
                                    </h4>
                                    <h4 class="">From Online Store</h4>
                                </div>
                                <div class="">
                                    <h4 class="mb-3">Total spent to date</h4>
                                    <h4 class="mb-3 font-semibold text-lg">
                                        {{ order.total }}
                                    </h4>
                                    <!-- <h4 class="">1 Order</h4> -->
                                </div>
                                <div>
                                    <h4 class="mb-3">Average order value</h4>
                                    <h4 class="mb-3 font-semibold text-lg">
                                        {{ order.average_total }}
                                    </h4>
                                    <h4></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        
                        <div class=" flex justify-between mt-4.5 pb-2 border-b-2 border-gray-200">
                          <p class="font-semibold text-lg">Timeline</p>
                          <div class="flex items-center">
                            <input type="checkbox" class="focus:ring-indigo-500 text-indigo-600 border-gray-300 mr-2" />
                            <p class="">Show comments</p>
                          </div>
                        </div>
                        <div class="mt-5 flex justify-evenly">
                            <div class="flex items-center">
                                <p class="h-10 w-10 rounded-full capitalize bg-blue-400 text-white text-center text-sm py-2.5 font-semibold mr-4">
                                    <!-- {{user.first_name.charAt(0)}}{{user.last_name.charAt(0)}} -->
                                    SA
                                </p>
                            </div>
                            <div class="w-full mr-2">
                                <input
                                    id="text3"
                                    type="text"
                                    placeholder="Leave a comment"
                                    class="
                                        w-full
                                        pl-4
                                        py-2
                                        rounded-md
                                        border border-gray-300
                                        text-gray-900
                                        placeholder-gray-300
                                        focus:outline-none
                                    "
                                />
                            </div>
                            <button
                                class="
                                    px-8
                                    py-2
                                    text-center
                                    bg-indigo-700
                                    border
                                    text-white
                                    rounded-md
                                "
                                @click="browseProduct"
                            >
                                Post
                            </button>
                        </div>
                    </div>
                        <p class="text-right text-gray-400 mt-1">Only you and other staff can see comments</p>
                    </div>

                <div class="flex flex-col w-1/3">
                    <div class="bg-white pl-5 pr-7 pb-10 pt-6 mb-5">
                        <div class="border-b border-gray-200 -mx-5 mb-6.5">
                            <div class="px-5 flex justify-between mb-4">
                                <h2 class="font-semibold text-xl">
                                    Customer overview
                                </h2>
                                <a
                                    href="/order/edit"
                                    class="text-indigo-700 font-semibold"
                                    >Edit</a
                                >
                            </div>
                            <div class="px-5 mb-6">
                                <h2 class="font-semibold text-indigo-700 mb-3">
                                    {{ getCustomer.email }}
                                </h2>
                                <h2 class="text-gray-400">
                                    Account invite sent
                                </h2>
                            </div>
                        </div>
                        <div class="border-b border-gray-200 -mx-5 mb-6.5">
                            <div class="px-5 flex justify-between mb-4">
                                <h2 class="font-semibold text-xl">
                                    Default Address
                                </h2>
                                <a
                                    href="/order/manage"
                                    class="text-indigo-700 font-semibold"
                                    >Manage</a
                                >
                            </div>
                            <div class="px-5 text-gray-500 mb-6">
                                <h2 class="font-normal mb-1">
                                    {{ getCustomer.first_name }}
                                    {{ getCustomer.last_name }}
                                </h2>
                                <h2 class="mb-1">{{ getCustomer.address }}</h2>
                                <!-- <h2 class="mb-1">Apt 402</h2> -->
                                <h2 class="mb-1">
                                    {{ getCustomer.city }}
                                    {{ getCustomer.state }}
                                </h2>
                                <h2 class="mb-6">{{ getCustomer.country }}</h2>
                                <a
                                    href="/order/address"
                                    class="font-semibold text-indigo-700"
                                    >Add new address</a
                                >
                            </div>
                        </div>
                        <div class="-mx-5">
                            <div class="px-5 flex justify-between mb-4">
                                <h2 class="font-semibold text-xl">
                                    Tax Settings
                                </h2>
                                <a
                                    href="/order/manage"
                                    class="text-indigo-700 font-semibold"
                                    >Manage</a
                                >
                            </div>
                            <div class="px-5 text-gray-400">
                                <h2>No exemptions</h2>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white pl-5 pr-7 pt-6 pb-9 mb-3">
                        <div class="flex justify-between">
                            <h2 class="font-semibold text-lg mb-6">
                                Email marketing
                            </h2>
                            <h2 class="text-cyan-700 font-semibold">
                                Unsubscribe
                            </h2>
                        </div>
                        <div
                            class="
                                mb-3.5
                                text-sm
                                inline-flex
                                leading-5
                                bg-green-100
                                text-green-500
                                px-2
                                py-1
                            "
                        >
                            Subscribed
                        </div>
                        <div class="">
                            <h2 class="font-semibold text-indigo-700 mb-3.5">
                                {{ getCustomer.email }}
                            </h2>
                            <h2 class="text-gray-400">
                                Subscribed on December 30, 2018
                            </h2>
                        </div>
                    </div>

                    <div class="bg-white pl-5 pr-7 pb-9 pt-6">
                        <div class="flex justify-between mb-4.5">
                            <h2 class="font-semibold text-lg">Tags</h2>
                            <h2 class="text-cyan-700 font-semibold">
                                View all tags
                            </h2>
                        </div>
                        <label for="search" class="sr-only">Search</label>
                        <input
                            id="text"
                            type="text"
                            placeholder="VIP, sale, shopper, etc"
                            class="
                                block
                                pl-3
                                py-2
                                rounded-md
                                border border-gray-300
                                text-gray-900
                                placeholder-gray-300
                                focus:outline-none
                                w-full
                            "
                        />
                    </div>

                     <div class="bg-white pl-5 mt-3 mb-3 pr-7 pb-9 pt-6">
                        <div class="flex justify-between mb-4.5">
                            <h2 class="font-semibold text-lg">Notes</h2>
                        </div>
                            <h2 v-if="order.note" class="text-cyan-700 font-semibold">
                                {{ order.note }}
                            </h2>
                            <p v-else class="font-normal text-base text-gray-400">No notes from customer</p>
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
import Nav from "../../Layouts/Nav";
import axios from "axios";
import EmptyProductModal from "./Components/EmptyProductModal.vue";
import ProductModal from "./Components/ProductModal.vue";
import ShippingModal from "./Components/ShippingModal.vue";
import DiscountModal from "./Components/DiscountModal.vue";
import TaxesModal from "./Components/TaxesModal.vue";
import NewCustomerModal from "./Components/NewCustomerModal.vue";
import BillingModal from "./Components/BillingModal.vue";
import AddressModal from "./Components/AddressModal.vue";
import TagModal from "./Components/TagModal.vue";
import MarkAsPaidModal from "./Components/MarkAsPaidModal.vue";
import ReserveItemsModal from "./Components/ReserveItemsModal.vue";

import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    ChevronLeftIcon,
    XIcon,
    PlusIcon,
    ChevronRightIcon,
    ArrowLeftIcon,
} from "@heroicons/vue/solid";
import { HomeIcon } from "@heroicons/vue/outline";
import hljs from "highlight.js";
// import InventoryForm from "./Components/InventoryForm";
// import ShippingForm from "./Components/ShippingForm";
// import VariantsForm from "./Components/VariantsForm";
// import SearchEngineForm from "./Components/SearchEngineForm";
// import MediaUrlModal from "./Components/MediaUrlModal";
// import PricingForm from "./Components/PricingForm";
import UploadIcon from "../../../assets/UploadIcon";
import AngleUpIcon from "../../../assets/AngleUpIcon";
import Multiselect from "@vueform/multiselect";
import Button from "../../Jetstream/Button.vue";
// import "vue-multiselect/dist/vue-multiselect.min.css";

const pages = [{ name: "Orders", href: "/orders", current: false }];

const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};
export default {
    props: {
        //products: Object,
        // filters: Object,
        order: Object,
        // orders: Array,
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
        // ShippingForm,
        // VariantsForm,
        // SearchEngineForm,
        // PricingForm,
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
        ReserveItemsModal,
        ChevronRightIcon,
        ArrowLeftIcon,
        HomeIcon,
    },

    data() {
        return {
            pages,
            valueContent: "",
            openShipping: false,
            selected: "",
            openDiscount: false,
            openTaxes: false,
            openCustomer: false,
            openBilling: false,
            openAddress: false,
            openTag: false,
            openMarkAsPaid: false,
            openReserve: false,
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
            qty: "",
            formFields: {
                title: "",
                description: "",
                brand: "",
            },
            note: "",
            variantSelected: [],
            openModal: false,
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
            products: [
                {
                    id: 1,
                    image: "https://picsum.photos/200",
                    description: "3.1 Dolce & Gabanna",
                    variants: [
                        {
                            image: "https://picsum.photos/200",
                            id: 1,
                            color: "Blue",
                            price: 100,
                            quantity: 20,
                            sku: 910,
                        },
                        {
                            image: "https://picsum.photos/200",
                            id: 2,
                            color: "Green",
                            price: 100,
                            quantity: 20,
                            sku: 930,
                        },
                    ],
                },
                {
                    id: 2,
                    image: "https://picsum.photos/200",
                    description: "3.1 Dolce & Gabanna",
                    variants: [
                        {
                            image: "https://picsum.photos/200",
                            id: 3,
                            color: "Blue",
                            price: 100,
                            quantity: 20,
                            sku: 78,
                        },
                        {
                            image: "https://picsum.photos/200",
                            id: 4,
                            color: "Green",
                            price: 100,
                            quantity: 20,
                            sku: 99,
                        },
                    ],
                },
                {
                    id: 3,
                    image: "https://picsum.photos/200",
                    description: "3.1 Dolce & Gabanna",
                    variants: [
                        {
                            image: "https://picsum.photos/200",
                            id: 5,
                            color: "Blue",
                            price: 100,
                            quantity: 20,
                            sku: 22,
                        },
                        {
                            image: "https://picsum.photos/200",
                            id: 6,
                            color: "Green",
                            price: 100,
                            quantity: 20,
                            sku: 26,
                        },
                    ],
                },
                {
                    id: 4,
                    image: "https://picsum.photos/200",
                    description: "3.1 Dolce & Gabanna",
                    variants: [
                        {
                            image: "https://picsum.photos/200",
                            id: 7,
                            color: "Orange",
                            price: 100,
                            quantity: 20,
                            sku: 33,
                        },
                        {
                            image: "https://picsum.photos/200",
                            id: 8,
                            color: "Green",
                            price: 100,
                            quantity: 20,
                            sku: 35,
                        },
                    ],
                },
                {
                    id: 5,
                    image: "https://picsum.photos/200",
                    description: "3.1 Dolce & Gabanna",
                    variants: [
                        {
                            image: "https://picsum.photos/200",
                            id: 9,
                            color: "Blue",
                            price: 100,
                            quantity: 20,
                            sku: 90,
                        },
                        {
                            image: "https://picsum.photos/200",
                            id: 10,
                            color: "Pink",
                            price: 100,
                            quantity: 20,
                            sku: 98,
                        },
                    ],
                },
                {
                    id: 6,
                    image: "https://picsum.photos/200",
                    description: "3.1 Dolce & Gabanna",
                    variants: {},
                },
                {
                    id: 7,
                    image: "https://picsum.photos/200",
                    description: "3.1 Dolce & Gabanna",
                    variants: {},
                },
                {
                    id: 8,
                    image: "https://picsum.photos/200",
                    description: "3.1 Dolce & Gabanna",
                    variants: [
                        {
                            id: 11,
                            color: "Black",
                            price: 100,
                            quantity: 20,
                            sku: 78,
                            image: "https://picsum.photos/200",
                        },
                        {
                            image: "https://picsum.photos/200",
                            id: 12,
                            color: "Baige",
                            price: 100,
                            quantity: 20,
                            sku: 899,
                        },
                    ],
                },
            ],
            production: [],
            subTotal: 0,
            taxes: 0,
            total: 0,
            email: false,
            pending: false,
            paid: false,
        };
    },
    computed: {
        getCustomer() {
            return this.order.user;
        },
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
            });
        },
        addVariantName(e) {
            let index = e.target.getAttribute("data-index");
            this.variants.options[index].name = e.target.value;
        },
        addVariantValue(e) {
            let index = e.target.getAttribute("data-index");
            this.variants.options[index].values.push(e.target.value);
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
            let attributes = this.variants;
            let total_count = 1;

            // a loop can do this
            if (attributes.indexOf(1) && attributes.indexOf(2)) {
                total_count =
                    attributes[0].values.length *
                    attributes[1].values.length *
                    attributes[2].values.length;
            }

            let g = [];
            let a = 0;

            let base_attribute = attributes[0];

            const gVal = (data, g) => {
                let c = g.length;
                if (data.values.indexOf(c)) return data.values[c];
                return "";
            };

            let z = [];

            //initialize variables first

            for (let j = 0; j < total_count; j++) {
                z[j] = [];
            }

            let q = 0;

            //first phase
            let first_attribute = total_count / attributes[0].values.length;

            for (let i = 0; i < base_attribute.values.length; i++) {
                for (let k = 0; k < first_attribute; k++) {
                    z[q].push(base_attribute.values[i]);
                    q++;
                }
            }

            let second_attributes = total_count / attributes[1].values.length;
            q = 0;

            for (let k = 0; k < second_attributes; k++) {
                for (let i = 0; i < attributes[1].values.length; i++) {
                    z[q].push(attributes[1].values[i]);
                    q++;
                }
            }

            let third_attributes = total_count / attributes[2].values.length;

            q = 0;
            for (let k = 0; k < third_attributes; k++) {
                for (let i = 0; i < attributes[2].values.length; i++) {
                    z[q].push(attributes[2].values[i]);
                    q++;
                }
            }

            console.log(z);
        },
        emitClose() {
            //console.log("object")
            this.openModal = false;
            this.openShipping = false;
            this.openDiscount = false;
            this.openTaxes = false;
            this.openCustomer = false;
            this.openBilling = false;
            this.openAddress = false;
            this.openTag = false;
            this.openMarkAsPaid = false;
            this.openReserve = false;
        },
        async getProducts() {
            //this.loading = true
            const products = await axios.post("/products/get-order-products");
            this.production = products.data.data;
            //this.loading = false
            console.log(products);
        },
        browseProduct() {
            this.openModal = true;
            this.getProducts();
        },
    },
    setup() {
        const open = ref(false);
        // console.log(order);

        // const order = orders

        return {
            statusStyles,
            pages,
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
