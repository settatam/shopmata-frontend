<template>
    <app-layout :navigation="navigation">
        <div class="flex-1 flex flex-col mt-4 min-h-screen">
            <nav class="flex px-8 mb-4" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a
                                href="/admin/dashboard"
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
                                href="/admin/customers"
                                class="ml-4 text-base font-medium text-gray-500 hover:text-gray-700 mt-1"
                                >{{ customer?.first_name }}
                                {{ customer?.last_name }}
                            </a>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="mx-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <CustomerInfo
                        :customer="customer"
                        :leads="leads"
                        :states="countries.states"
                        :tags="tags"
                    />
                </div>

                <div>
                    <CustomerSales :customer="customer" />
                    <!-- <PaymentInformation
                        :states="countries.states"
                        :customer="customer"
                    /> -->
                </div>
            </div>
        </div>

        <div>
            <Images :payload="payload" :imgs="customer.images" class="mb-8" />
        </div>

        <div>
            <TransactionTable
                :transactions="customer.transactions"
                class="m-4"
            />
        </div>
    </app-layout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import Search from "../Search.vue";
import Nav from "../../Layouts/Nav";
import axios from "axios";
import CustomerInfo from "./Components/CustomerInfo.vue";
import CustomerSales from "./Components/CustomerSales.vue";
import PaymentInformation from "./Components/PaymentInformation.vue";
import TransactionTable from "./Components/TransactionTable.vue";
import Images from "../../Components/Images.vue";

import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { ChevronRightIcon } from "@heroicons/vue/solid";
import { HomeIcon } from "@heroicons/vue/outline";
import Button from "../../Jetstream/Button.vue";

const pages = [
    { name: "All Customers", href: "/admin/customers", current: false },
];

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
        store: Object,
        navigation: Array,
        countries: Object,
        transaction: Object,
        leads: Array,
        tags: Array,
    },

    components: {
        Nav,
        AppLayout,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        Button,
        ChevronRightIcon,
        HomeIcon,
        CustomerInfo,
        CustomerSales,
        PaymentInformation,
        TransactionTable,
        Images,
    },

    data() {
        return {
            pages,
        };
    },

    setup(props) {
        const payload = ref({
            model: "Customer",
            customer_id: props.customer.id,
        });

        return {
            statusStyles,
            pages,
            payload,
        };
    },
};
</script>
