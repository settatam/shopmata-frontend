<template>
    <app-layout>
        <!-- Page header -->
        <div id="container" class="flex flex-col mx-3">
                        <div class="flex flex-row justify-between">
                <div class="flex flex-col justify-start m-3">
                    <h1 class="mt-4 font-bold">Transactions</h1>
                </div>

                <div class="lg:hidden flex flex-row justify-start mr-3 py-4">
                    <button
                        class="bg-purple-darken px-2 py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken inline-flex items-center"
                        type="submit"
                    >
                        <PlusIcon class="h-4 w-5 inline-flex items-center" />
                        <span class="pl-2">Add Customer</span>
                    </button>
                </div>
            </div>

            <!-- Search start -->
            <div class="mx-3">
                <label for="Search" class="text-xs text-black font-medium py-2"
                    >Search</label
                >
                <div
                    class="relative text-gray-600 focus-within:text-gray-background "
                >
                    <span
                        class="absolute inset-y-0 left-0 flex items-center pl-2"
                    >
                        <button
                            type="submit"
                            class="p-1 focus:outline-none focus:shadow-outline"
                        >
                            <SearchIcon class="h-5 w-5 text-gray-background" />
                        </button>
                    </span>
                    <input
                        type="search"
                        class="py-2 text-sm text-black rounded-md pl-10 focus:outline-none focus:bg-white w-full lg:w-2/4"
                        placeholder="Search by name, email....."
                        autocomplete="off"
                    />
                </div>
            </div>
            <!-- Search end -->

            <!-- transaction items -->
            <table class="my-4 mx-3 bg-white rounded-md">
                                <thead class="border-b table-auto">
                    <tr class="font-semibold tracking-wide text-left">
                        <th
                            class="text-sm font-medium text-gray-600 px-5 mr-1 py-1"
                            scope="col"
                        >
                            Items
                        </th>
                        <th
                            class="text-sm font-medium text-gray-600 px-5 mr-1 py-1"
                            scope="col"
                        >
                            Customers
                        </th>
                    </tr>
                </thead>
                                <tbody>
                    <tr
                        v-for="item in transactions"
                        :key="item.index"
                        class="py-3"
                    >
                        <td class="">
                            <div class="py-4 px-6 flex flex-col">
                                <td class="text-gray-darken text-sm">
                                    Multiple item:
                                    <span class="text-black font-medium">{{
                                        item.multipleItem
                                    }}</span>
                                </td>
                                <td class="text-gray-darken text-sm">
                                    Description:
                                    <span class="text-black font-medium">{{
                                        item.description
                                    }}</span>
                                </td>
                                <td class="text-gray-darken text-sm">
                                    Comments:
                                    <span class="text-black font-medium">{{
                                        item.comments
                                    }}</span>
                                </td>
                            </div>
                        </td>
                        
                        <td class="flex flex-col lg:flex-row border-b border-gray-background">
                            <!-- trans info -->
                            <div class="py-4 px-6 flex flex-col">
                                <td class="text-purple-darken font-bold">
                                    Transaction {{ item.transactionNumber }}
                                </td>
                                <td class="text-gray-darken text-sm">
                                    {{ item.transactionDate }}
                                </td>
                                <td class="text-black font-medium">
                                    {{ item.customerName }}
                                </td>
                                <td class="text-black font-medium">
                                    {{ item.transactionLocation }}
                                </td>
                                <td>
                                    <MailIcon class="h-5 w-5" />
                                </td>
                            </div>
                            <div class="flex flex-col justify-start mx-6 py-4">
                                <button
                                    class="bg-purple-darken px-6 py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken"
                                    type="submit"
                                >
                                    Send Kit
                                </button>
                            </div>
                                                    </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </app-layout>
</template>
<script>
import { ref, reactive } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import axios from 'axios'
import { SearchIcon, PlusIcon } from '@heroicons/vue/solid'
import { MailIcon } from '@heroicons/vue/outline'
const transactions = [
    {
        multipleItem: '2 silver Liberty dollars',
        description: '',
        comments: '',
        transactionNumber: '#4004',
        transactionDate: '2022-06-01 08:45:23',
        customerName: 'Rick London',
        transactionLocation: 'Philadelphia, PA'
    }
]
const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}
export default {
    components: {
        AppLayout,
        SearchIcon,
                MailIcon,
        PlusIcon
    },
    props: {
        notifications: Array
    },
    setup (props) {
        const open = ref(false)
        const notifications = props.notifications
        const transactions = reactive([
            {
                multipleItem: '2 silver Liberty dollars',
                description: '',
                comments: '',
                transactionNumber: '#4004',
                transactionDate: '2022-06-01 08:45:23',
                customerName: 'Rick London',
                transactionLocation: 'Philadelphia, PA'
            },
            {
                multipleItem: '2 silver Liberty dollars',
                description: '',
                comments: '',
                transactionNumber: '#4004',
                transactionDate: '2022-06-01 08:45:23',
                customerName: 'Rick London',
                transactionLocation: 'Philadelphia, PA'
            },
            {
                multipleItem: '2 silver Liberty dollars',
                description: '',
                comments: '',
                transactionNumber: '#4004',
                transactionDate: '2022-06-01 08:45:23',
                customerName: 'Rick London',
                transactionLocation: 'Philadelphia, PA'
            }
        ])
        return {
            transactions,
            statusStyles
            // notifications
        }
    }
}
</script>