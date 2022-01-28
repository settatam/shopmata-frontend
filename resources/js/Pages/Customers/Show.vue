<template>
    <app-layout>
        <div class="flex-1 flex flex-col mt-4 min-h-screen">
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
                                <span class="sr-only">Customers</span>
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
                                class="ml-4 text-base font-medium text-gray-400 hover:text-gray-700 mt-1"
                                :aria-current="
                                    page.current ? 'page' : undefined
                                "
                                >{{ page.name }}</a
                            >
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <ChevronRightIcon
                                class="flex-shrink-0 h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                            <a
                                href="/customers"
                                class="ml-4 text-base font-medium text-gray-500 hover:text-gray-700 mt-1"
                                >{{ customer?.first_name }}
                                {{ customer?.last_name }}
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- <div class="mx-8 mt-4 mb-7">
                <a href="/customers" class="hover:text-gray-700">
                    <div class="flex items-center">
                        <ArrowLeftIcon
                            class="flex-shrink-0 h-5 w-5"
                            aria-hidden="true"
                        />
                        <h1 class="ml-4 text-lg font-semibold">
                            {{ customer?.first_name }}
                            {{ customer?.last_name }}
                        </h1>
                    </div>
                </a>
            </div> -->

            <div class="mx-6 flex mt-3">
                <!-- Customer causing the white section below -->
                <div
                    class="bg-white pl-5 pr-7 pb-10 pt-6 mb-5 rounded w-1/3 mr-4"
                >
                    <div class="border-b border-gray-200 -mx-5 mb-6.5">
                        <div class="px-5 flex justify-between mb-4">
                            <h2 class="font-bold text-lg">Customer Overview</h2>
                            <a
                                href="/customers/edit"
                                class="text-indigo-700 font-semibold text-xs"
                                >Edit Details</a
                            >
                        </div>

                        <div class="px-5 mb-6 flex">
                            <div class="flex mr-2 mt-1">
                                <p
                                    class="h-14 w-14 rounded-full capitalize bg-gray-100 text-black text-lg flex items-center justify-center font-semibold"
                                >
                                    {{ customer?.first_name.charAt(0)
                                    }}{{ customer?.last_name.charAt(0) }}
                                </p>
                            </div>
                            <div class="flex flex-col">
                                <inertia-link
                                    :href="'/customers/' + customer.id"
                                    >{{ customer.first_name }}
                                    {{ customer.last_name }}</inertia-link
                                >

                                <h2
                                    class="font-semibold text-indigo-700 mb-1 text-xs lg:text-base"
                                >
                                    {{ customer.email }}
                                </h2>
                                <!-- <h2 class="text-gray-400">
                                        {{ getCustomer.activation_status }}
                                    </h2> -->
                                <!-- <h2 class="text-gray-400">
                                        {{ getCustomer.phone_number }}
                                    </h2> -->
                                <h2 class="text-black text-xs lg:text-base">
                                    {{ customer?.phone }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="border-b border-gray-200 -mx-5 mb-6.5">
                        <div class="px-5 flex justify-between mb-4">
                            <h2 class="font-bold">Billing Address</h2>
                        </div>
                        <div class="px-5 text-gray-500 mb-6 text-xs">
                            <h2 class="font-normal mb-1">
                                {{ customer?.first_name }}
                                {{ customer?.last_name }}
                            </h2>
                            <h2 class="mb-1">{{ store.address }}</h2>
                            <h2 class="mb-1"></h2>
                            <h2 class="mb-1">
                                {{ customer?.city }}
                                {{ customer?.state }}
                            </h2>
                            <h2 class="mb-6">
                                {{ customer?.country }}
                            </h2>
                            <!-- <a
                                    href="/order/address"
                                    class="font-semibold text-indigo-700"
                                    >Add new address</a
                                > -->
                        </div>
                    </div>
                    <div class="border-b border-gray-200 -mx-5 mb-6.5">
                        <div class="px-5 flex justify-between mb-4">
                            <h2 class="font-bold">Shipping Address</h2>
                        </div>
                        <div class="px-5 text-gray-500 mb-6 text-xs">
                            <h2 class="font-normal mb-1">
                                {{ customer.first_name }}
                                {{ customer.last_name }}
                            </h2>
                            <h2 class="mb-1">{{ customer?.address }}</h2>
                            <h2 class="mb-1"></h2>
                            <h2 class="mb-1">
                                {{ customer?.city }}
                                {{ customer?.state }}
                            </h2>
                            <h2 class="mb-6">
                                {{ customer?.country }}
                            </h2>
                            <!-- <a
                                    href="/order/address"
                                    class="font-semibold text-indigo-700"
                                    >Add new address</a
                                > -->
                        </div>
                    </div>
                </div>

                <div class="w-2/3">
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-white py-6 mb-4 px-4 rounded-sm">
                            <div class="flex flex-col">
                                <total-revenue />
                                <h2 class="font-bold text-lg mb-1 mt-2.5">
                                    <!-- {{ store.currency.symbol_left }} -->
                                    {{
                                        store.currency.code + " "+
                                        customer.total_orders
                                    }}
                                </h2>
                                <p class="text-gray-400">Total Amount</p>
                            </div>
                        </div>
                        <div class="bg-white py-6 px-4 mb-4 rounded-sm">
                            <div class="flex flex-col">
                                <orders-placed />
                                <h2 class="font-bold text-lg mb-1 mt-2.5">
                                    {{ customer.number_of_orders }}
                                </h2>
                                <p class="text-gray-400">Total Orders Placed</p>
                            </div>
                        </div>
                        <div class="bg-white py-6 px-4 mb-4 rounded-sm">
                            <div class="flex flex-col">
                                <pending-orders />
                                <h2 class="font-bold text-lg mb-1 mt-2.5">
                                    {{ customer.pending_order }}
                                </h2>
                                <p class="text-gray-400">Pending Order</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="shadow-sm rounded-lg overflow-hidden mt-4 bg-white"
                    >
                        <div
                            class="py-3 px-5 flex justify-between items-center"
                        >
                            <h2 class="uppercase font-semibold">
                                Total Revenue
                            </h2>
                            <div>
                                <select
                                    id="month"
                                    name="month"
                                    className="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                    defaultValue="February"
                                >
                                    <option value="" selected disabled>
                                        Month
                                    </option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                        </div>
                        <div id="chart-1" class="p-6" style="height: 500px">
                            <column-chart
                                :colors="['#4338CA']"
                                prefix="$"
                                :data="[
                                    ['8 Feb', 900],
                                    ['12 Feb', 450],
                                    ['16 Feb', 480],
                                    ['20 Feb', 850],
                                    ['21 Feb', 950],
                                    ['22 Feb', 350],
                                ]"
                            ></column-chart>
                        </div>
                        <!-- <canvas class="p-10" id="chartBar"></canvas> -->
                    </div>

                    <div class="flex flex-col mt-6 mb-4">
                        <div class="">
                            <div class="flex flex-col">
                                <div
                                    class="min-w-full overflow-x-auto shadow sm:rounded"
                                >
                                    <table
                                        class="w-full divide-y bg-white divide-gray-200"
                                    >
                                        <thead class="bg-white">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="whitespace-nowrap px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Order ID
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="whitespace-nowrap px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Date
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="whitespace-nowrap px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Products
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="whitespace-nowrap px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Qty
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="whitespace-nowrap px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Total
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="whitespace-nowrap px-3 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Payment
                                                </th>
                                                <!-- <th
                                                    scope="col"
                                                    class="
                                                        py-3
                                                        whitespace-nowrap
                                                        px-3
                                                        text-left text-sm
                                                        font-medium
                                                        text-gray-500
                                                        uppercase
                                                        tracking-wider
                                                    "
                                                >
                                                    Actions
                                                </th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            <tr
                                                class=""
                                                v-for="order in customer.orders"
                                                :key="order.id"
                                            >
                                                <inertia-link
                                                    :href="
                                                        '/orders/' + order.id
                                                    "
                                                    class=""
                                                >
                                                    <td
                                                        class="px-3 pt-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider"
                                                    >
                                                        {{ order.order_id }}
                                                    </td>
                                                </inertia-link>
                                                <td
                                                    class="px-3 text-left text-base font-medium text-gray-500 tracking-wider"
                                                >
                                                    {{ order.created_at }}
                                                </td>
                                                <td
                                                    class="px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    {{ order.items.id }}
                                                </td>
                                                <td
                                                    class="px-3 text-base pl-6 font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    {{ order.items.length }}
                                                </td>
                                                <td
                                                    class="px-3 text-base font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    {{
                                                        store.currency
                                                            .symbol_left +
                                                        order.total
                                                    }}
                                                </td>
                                                <td
                                                    class="px-3 text-left text-base font-medium text-gray-500 tracking-wider"
                                                >
                                                    <div
                                                        class="sm:pr-2 md:pr-4 py-3 text-left leading-4 font-semibold tracking-wide"
                                                    >
                                                        <div>
                                                            <span
                                                                :class="[
                                                                    statusStyles[
                                                                        order
                                                                            .status
                                                                    ],
                                                                    'inline-flex items-center px-2.5 py-1 text-xs font-medium capitalize',
                                                                ]"
                                                            >
                                                                {{
                                                                    order.status
                                                                }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- <td>
                                                    <div class="pl-5">
                                                        <PencilIcon
                                                            class="
                                                                w-5
                                                                h-5
                                                                text-indigo-600
                                                                cursor-pointer
                                                                mr-4
                                                            "
                                                        />
                                                        <TrashIcon
                                                            class="
                                                                w-5
                                                                h-5
                                                                text-red-500
                                                                cursor-pointer
                                                            "
                                                        />
                                                    </div>
                                                </td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="flex flex-col w-1/3">
                    <div class="bg-white py-6 mb-4 px-4">
                        <div class="flex items-center justify-center mt-8">
                            <p
                                class="
                                    h-16
                                    w-16
                                    rounded-full
                                    capitalize
                                    bg-blue-400
                                    text-white text-lg
                                    flex
                                    items-center
                                    justify-center
                                    py-2.5
                                    font-semibold
                                "
                            >
                                {{ customer?.first_name.charAt(0)
                                }}{{ customer?.last_name.charAt(0) }}
                            </p>
                        </div>
                        <div
                            class="
                                flex flex-col
                                items-center
                                justify-center
                                mt-3
                            "
                        >
                            <h2 class="mb-1 text-xl text-gray-900">
                                {{ customer?.first_name }}
                                {{ customer?.last_name }}
                            </h2>
                            <p class="text-gray-400">{{ customer?.email }}</p>
                            <p class="text-gray-400">
                                {{ customer?.phone_number }}
                            </p>
                        </div>

                        <div class="flex justify-between mt-9">
                            <div class="flex">
                                <LocationMarkerIcon
                                    class="text-gray-400 h-5 w-5 mt-1"
                                />
                                <div class="ml-4">
                                    <h2 class="font-semibold">Address</h2>
                                    <p>{{ customer.address }}</p>
                                </div>
                            </div>
                            <div>
                                <PencilIcon
                                    class="
                                        w-5
                                        h-5
                                        text-indigo-600
                                        cursor-pointer
                                        mr-4
                                    "
                                />
                            </div>
                        </div>
                        <div class="flex justify-between mt-9">
                            <div class="flex">
                                <LocationMarkerIcon
                                    class="text-gray-400 h-5 w-5 mt-1"
                                />
                                <div class="ml-4">
                                    <h2 class="font-semibold">ZIP</h2>
                                    <p>{{ customer.zip_postal_code }}</p>
                                </div>
                            </div>
                            <div>
                                <PencilIcon
                                    class="
                                        w-5
                                        h-5
                                        text-indigo-600
                                        cursor-pointer
                                        mr-4
                                    "
                                />
                            </div>
                        </div>
                        <div class="flex justify-between mt-9">
                            <div class="flex">
                                <CalendarIcon
                                    class="text-gray-400 h-5 w-5 mt-1"
                                />
                                <div class="ml-4">
                                    <h2 class="font-semibold">Date Joined</h2>
                                    <p>
                                        {{
                                            moment(customer.created_at).format(
                                                "YYYY-MM-DD"
                                            )
                                        }}
                                        
                                    </p>
                                </div>
                            </div>
                            <div>
                                <PencilIcon
                                    class="
                                        w-5
                                        h-5
                                        text-indigo-600
                                        cursor-pointer
                                        mr-4
                                    "
                                />
                            </div>
                        </div>
                    </div>
                </div> -->
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
import {
    HomeIcon,
    LocationMarkerIcon,
    PencilIcon,
    CalendarIcon,
    TrashIcon,
} from "@heroicons/vue/outline";
import hljs from "highlight.js";
import UploadIcon from "../../../assets/UploadIcon";
import AngleUpIcon from "../../../assets/AngleUpIcon";
import Multiselect from "@vueform/multiselect";
import Button from "../../Jetstream/Button.vue";
import PendingOrders from "../../../assets/PendingOrders.vue";
import TotalRevenue from "../../../assets/TotalRevenue.vue";
import OrdersPlaced from "../../../assets/OrdersPlaced.vue";
import moment from "moment";
// import "vue-multiselect/dist/vue-multiselect.min.css";

const pages = [{ name: "All Customers", href: "/customers", current: false }];

const statusStyles = {
    received: "bg-green-100 text-green-800",
    shipped: "bg-green-100 text-green-800",
    delivered: "bg-green-100 text-green-800",
    fulfilled: "bg-green-100 text-green-800",
    confirmed: "bg-green-100 text-green-800",
    pending: "bg-yellow-100 text-yellow-800",
    returned: "bg-yellow-100 text-yellow-800",
    refunded: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
    expired: "bg-gray-100 text-gray-800",
    cancelled: "bg-red-100 text-red-800",
};

export default {
    props: {
        customer: Object,
        orders: Object,
        store: Object,
        data: Object,
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
        ChevronLeftIcon,
        XIcon,
        PlusIcon,
        ChevronRightIcon,
        ArrowLeftIcon,
        HomeIcon,
        TotalRevenue,
        PendingOrders,
        OrdersPlaced,
        TotalRevenue,
        LocationMarkerIcon,
        PencilIcon,
        CalendarIcon,
        TrashIcon,
    },

    data() {
        return {
            pages,
            moment,
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
            return this.customer;
        },
        // myProps() {
        //     return { data: this.orders.data, links: this.orders.links };
        // },
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
        total_orders() {
            return parseFloat(this.total_orders).toFixed(2);
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
        toggle(data) {
            data = !data;
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
