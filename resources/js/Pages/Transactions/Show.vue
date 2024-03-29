<template>
    <app-layout :navigation="navigation">
        <div id="container">
            <div class="bg-gray-background w-full flex flex-col lg:space-y-2 px-4">
                <!-- nav start -->
                <nav class="flex px-6 pt-8" aria-label="Breadcrumb">
                    <ol role="list" class="flex items-center space-x-4">
                        <li>
                            <div>
                                <a href="/admin/dashboard" class="text-gray-400 hover:text-gray-500">
                                    <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
                                    <span class="sr-only">Settings</span>
                                </a>
                            </div>
                        </li>
                        <li v-for="page in pages" :key="page.name">
                            <div class="flex items-center">
                                <ChevronRightIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
                                <a :href="page.href" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                                    :aria-current="
                                        page.current ? 'page' : undefined
                                    ">{{ page.name }}</a>
                            </div>
                        </li>
                    </ol>
                </nav>

                <!-- nav end -->
                <!-- container for  containers -->
                <div class="flex flex-col lg:flex-row w-full h-full mb-12">
                    <div class="w-full lg:w-1/3">
                        <TransactionBox1 :transaction="trans" :store="store" class="mb-4 h-full" />
                    </div>
                    <div class="w-full lg:w-1/3">
                        <KitInformation class="mb-4 h-full" :categories="transaction_categories" :transaction="trans"
                            :top_tags="top_tags" />
                    </div>

                    <div class="w-full lg:w-1/3 h-full">
                        <div>
                            <CustomerInformation :customer="trans.customer" class="mb-4" />
                        </div>
                        <div>
                            <PaymentInformation :transaction_id="trans.id" />
                        </div>
                        <div>
                            <TrafficSource class="mb-4" />
                        </div>
                    </div>
                </div>

                <!-- row 3 -->
                <div class="w-full">
                    <ItemTable :root="trans" :items="trans.items" :categories="transaction_item_categories"
                        class="lg:mt-16 mb-12" />
                </div>
                <!-- row 3 ends -->

                <!-- row 4 -->
                <div class="w-full">
                    <TransactionTimeline class="mb-12" :root="trans" :transaction="trans" :loading="loading"
                        :bottom_tags="bottom_tags" :statuses="statuses" :timeline="timeline"
                        @transactionUpdated="updateTransaction" />
                </div>
                <!-- row 4 starts -->

                <!-- row 5 starts -->
                <div class="w-full">
                    <shopmata-table :filters="customerFilters"></shopmata-table>
                </div>
                <!-- row 5 ends -->

                <!-- Scan row starts -->
                <div class="w-full">
                    <Scans class="mb-12" />
                </div>

                <div class="w-full">
                    <ShopmataTable :filters="activityFilters" />
                </div>
            </div>

            <NotificationGroup group="top" position="top">
                <div class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none">
                    <div class="w-full max-w-sm">
                        <Notification v-slot="{ notifications, close }"
                            enter="transform ease-out duration-300 transition"
                            enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                            enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                            leave="transition ease-in duration-500" leave-from="opacity-100" leave-to="opacity-0"
                            move="transition duration-500" move-delay="delay-300">
                            <div class="w-full max-w-sm mt-4 overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5"
                                v-for="notification in notifications" :key="notification.id">
                                <div class="p-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="w-6 h-6 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3 w-0 flex-1 pt-0.5">
                                            <p class="font-semibold text-gray-800">
                                                {{ notification.title }}
                                            </p>
                                            <p class="text-sm font-semibold text-gray-500">
                                                {{ notification.text }}
                                            </p>
                                        </div>
                                        <div class="flex flex-shrink-0 ml-4">
                                            <button @click="close(notification.id)"
                                                class="inline-flex text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                                <span class="sr-only">Close</span>
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </Notification>
                    </div>
                </div>
            </NotificationGroup>

            <NotificationGroup group="bottom" position="top">
                <div class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none">
                    <div class="w-full max-w-sm">
                        <Notification v-slot="{ notifications }" enter="transform ease-out duration-300 transition"
                            enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                            enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                            leave="transition ease-in duration-500" leave-from="opacity-100" leave-to="opacity-0"
                            move="transition duration-500" move-delay="delay-300">
                            <div class="flex w-full max-w-sm mx-auto mt-4 overflow-hidden bg-white rounded-lg shadow-md"
                                v-for="notification in notifications" :key="notification.id">
                                <div class="flex items-center justify-center w-12 bg-red-500">
                                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                        </path>
                                    </svg>
                                </div>

                                <div class="px-4 py-2 -mx-3">
                                    <div class="mx-3">
                                        <span class="font-semibold text-red-500">{{ notification.title }}</span>
                                        <p class="text-sm text-gray-600">
                                            {{ notification.text }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </Notification>
                    </div>
                </div>
            </NotificationGroup>
        </div>
    </app-layout>
</template>

<script>
import { ref, computed, watch, reactive } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import axios from "axios";
import TransactionBox1 from "./Components/TransactionBox1.vue";
import KitInformation from "./Components/KitInformation.vue";
import CustomerInformation from "./Components/CustomerInformation.vue";
import PaymentInformation from "./Components/PaymentInformation.vue";
import TransactionTimeline from "./Components/TransactionTimeline.vue";
import ItemTable from "./Components/ItemTable.vue";
import TrafficSource from "./Components/TrafficSource.vue";
import TransactionsTable from "./Components/TransactionsTable.vue";
import Actions from "./Components/Actions.vue";
import Scans from "./Components/Scans.vue";
import ShopmataTable from "../Widgets/ShopmataTable";
import { ChevronRightIcon, HomeIcon } from "@heroicons/vue/solid";
import ImageSlider from "../Widgets/ImageSlider";
import urls from "../../api/urls";
import { Inertia } from "@inertiajs/inertia";

const pages = [
    { name: "Transactions", href: "/admin/transactions", current: false },
    {
        name: "Transaction Report",
        href: "",
        current: true,
    },
];

const testImages = [
    "https://i.picsum.photos/id/1/200/300.jpg?hmac=jH5bDkLr6Tgy3oAg5khKCHeunZMHq0ehBZr6vGifPLY",
    "https://i.picsum.photos/id/2/200/300.jpg?hmac=HiDjvfge5yCzj935PIMj1qOf4KtvrfqWX3j4z1huDaU",
    "https://i.picsum.photos/id/3/200/300.jpg?hmac=o1-38H2y96Nm7qbRf8Aua54lF97OFQSHR41ATNErqFc",
];

export default {
    components: {
        ImageSlider,
        AppLayout,
        TransactionBox1,
        KitInformation,
        CustomerInformation,
        PaymentInformation,
        TransactionTimeline,
        ItemTable,
        TrafficSource,
        ChevronRightIcon,
        HomeIcon,
        TransactionsTable,
        Actions,
        Scans,
        ShopmataTable,
    },
    props: {
        notifications: Array,
        transaction: Object,
        transaction_categories: Array,
        transaction_item_categories: Array,
        statuses: Array,
        top_tags: Array,
        bottom_tags: Array,
        timeline: Array,
        navigation: Array,
        store: Object,
        states: Array,
    },

    setup(props) {
        const notifications = props.notifications;
        let trans = ref(props.transaction)
        const customerFilters = {
            customer_id: props.transaction.customer.id,
            type: "CustomerTransactionsTable",
        };
        const loading = ref(false)

        const activityFilters = {
            type: "TransactionActionsTable",
            transaction_id: props.transaction.id,
        };

        function updateTransaction(data) {
            loading.value = true

            let currentData = {};
            currentData[data.field] = data.value;
            let url = "";
            let method = "put";
            switch (data.field) {
                case "offer":
                    url =
                        "/admin/transactions/" +
                        props.transaction.id +
                        "/offer";
                    method = "post";
                    break;
                case "send-offer":
                    url =
                        "/admin/transactions/" +
                        props.transaction.id +
                        "/send-offer";
                    method = "post";
                    break;
                case "message":
                    currentData.type = data.type;
                    url = urls.transactions.message(props.transaction.id);
                    method = "post";
                    break;
                case "new-kit":
                    currentData.type = data.type;
                    url = urls.transactions.newKit(props.transaction.id);
                    method = "post";
                    break;
                default:
                    method = "put";
                    url = "/admin/transactions/" + props.transaction.id;
            }

            if (method == "put") {
                axios.put(url, currentData).then((res) => {
                    trans.value = res.data
                    loading.value = false
                });
            }
            else {
                axios.post(url, currentData).then((res) => {
                    if (data.field == "new-kit") {
                        Inertia.visit(urls.transactions.main(res.data.id));
                        loading.value = false
                    } else {
                        props.transaction.value = res.data;
                    }
                });
            }
        }

        return {
            pages,
            updateTransaction,
            customerFilters,
            activityFilters,
            testImages,
            trans,
            loading
        };
    },
};
</script>



