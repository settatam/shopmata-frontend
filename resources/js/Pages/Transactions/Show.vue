<template>
    <app-layout>
        <div id="container">
            <div
                class="bg-gray-background w-full flex flex-col lg:space-y-2 px-4"
            >
                <!-- nav start -->
                <nav class="flex px-6 pt-8" aria-label="Breadcrumb">
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
                                    <span class="sr-only">Settings</span>
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
                                    class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                                    :aria-current="
                                        page.current ? 'page' : undefined
                                    "
                                    >{{ page.name }}</a
                                >
                            </div>
                        </li>
                    </ol>
                </nav>

                <!-- nav end -->
                <!-- container for  containers -->
                <div class="flex flex-col lg:flex-row w-full h-full mb-12">
                    <div class="w-full lg:w-1/3">
                        <TransactionBox1
                            :transaction="transaction"
                            class="mb-4 h-full"
                        />
                    </div>
                    <div class="w-full lg:w-1/3 ">
                        <KitInformation
                            class="mb-4 h-full"
                            :categories="categories"
                            :transaction="transaction"
                            :top_tags="top_tags"
                        />
                    </div>
                    <div class="w-full lg:w-1/3 h-full">
                        <div>
                            <CustomerInformation
                                :customer="transaction.customer"
                                class="mb-4 "
                            />
                        </div>
                        <div>
                            <PaymentInformation class="mb-4" />
                        </div>
                        <div>
                            <TrafficSource class="mb-4" />
                        </div>
                    </div>
                </div>

                <!-- row 3 -->
                <div class="w-full">
                    <ItemTable
                        :transaction="transaction.items"
                        class="lg:mt-16 mb-12"
                    />
                </div>
                <!-- row 3 ends -->

                <!-- row 4 -->
                <div class="w-full">
                    <TransactionTimeline
                        class="mb-12"
                        :transaction="transaction.notes"
                        :bottom_tags="bottom_tags"
                        :statuses="statuses"
                    />
                </div>
                <!-- row 4 starts -->

                <!-- row 5 starts -->
                <div class="w-full">
                    <TransactionsTable
                        :transaction="transaction"
                        class="mb-12"
                    />
                </div>
                <!-- row 5 ends -->

                <!-- Scan row starts -->
                <div class="w-full">
                    <Scans
                        class="mb-12"
                    />
                </div>

                <!-- Scan row ends -->

                <!-- row 6 starts -->
                <div class="w-full">
                    <Actions
                        :transaction="transaction.activities"
                        class="mb-12"
                    />
                </div>
                <!-- row 6 ends -->
            </div>
        </div>
    </app-layout>
</template>

<script>
import { ref, computed, watch, reactive } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import axios from 'axios'
import TransactionBox1 from './Components/TransactionBox1.vue'
import KitInformation from './Components/KitInformation.vue'
import CustomerInformation from './Components/CustomerInformation.vue'
import PaymentInformation from './Components/PaymentInformation.vue'
import TransactionTimeline from './Components/TransactionTimeline.vue'
import ItemTable from './Components/ItemTable.vue'
import TrafficSource from './Components/TrafficSource.vue'
import TransactionsTable from './Components/TransactionsTable.vue'
import Actions from './Components/Actions.vue'
import Scans from './Components/Scans.vue'
import { ChevronRightIcon, HomeIcon } from '@heroicons/vue/solid'

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}

const pages = [
    { name: 'Transactions', href: '/transactions', current: false },
    {
        name: 'Transaction Report',
        href: '',
        current: true
    }
]

export default {
    components: {
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
    },
    props: {
        notifications: Array,
        transaction: Object,
        categories: Array,
        statuses: Array,
        top_tags: Array,
        bottom_tags: Array,
        statuses: Array,
    },

    setup (props) {
        const open = ref(false)
        const notifications = props.notifications

        return {
            statusStyles,
            pages
        }
    }
}
</script>
