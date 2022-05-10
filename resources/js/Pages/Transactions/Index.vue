<template>
    <!-- Page header -->
    <app-layout :navigation="navigation">
        <div id="container" class="flex flex-col mx-3">
            <div class="flex flex-row justify-between">
                <div class="flex flex-col justify-start my-3 mx-3">
                    <h1 class="mt-4 font-bold">Transactions</h1>
                    <label
                        for="Search"
                        class="text-xs text-black font-medium py-2"
                        >Search</label
                    >
                </div>

                <!-- <div class="lg:hidden flex flex-row justify-start mr-3 py-4">
                    <button
                        class="bg-purple-darken px-2 py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken inline-flex items-center"
                        type="submit"
                    >
                        <PlusIcon class="h-4 w-5 inline-flex items-center" />
                        <span class="pl-2">Add Customer</span>
                    </button>
                </div> -->
            </div>

            <div
                class="mx-3 flex flex-col lg:flex-row justify-center md:justify-between  space-y-4 lg:space-y-0 lg:space-x-0"
            >
                <!-- Search start -->
                <div class="flex flex-row space-x-2 w-auto">
                    <div class="">
                        <select
                            class="rounded text-black bg-white text-xm md:text-base w-20 "
                            name=""
                            id=""
                        >
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div
                        class="relative text-gray-600 focus-within:text-gray-background w-96"
                    >
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-2"
                        >
                            <button
                                type="submit"
                                class="p-1 focus:outline-none focus:shadow-outline"
                            >
                                <SearchIcon
                                    class="h-5 w-5 text-gray-background "
                                />
                            </button>
                        </span>
                        <input
                            type="search"
                            class="py-2 text-sm text-black rounded-md pl-10 focus:outline-none focus:bg-white w-full lg:w-full"
                            placeholder="Search by name, email....."
                            autocomplete="off"
                        />
                    </div>
                </div>
                <!-- Search end -->

                <div class="flex flex-row space-x-2">
                    <!-- mass action dropdown start -->
                    <div class="">
                        <select
                            class="py-2 text-sm text-black rounded-md focus:outline-none focus:bg-white w-72 lg:w-full"
                            name="massaction"
                            id=""
                            v-model="massActionChoice"
                        >
                            <option value="choose">Choose</option>
                            <option value="label_to"
                                >Create Shipping label to customer</option
                            >
                            <option value="label_from"
                                >Create Shipping label from customer</option
                            >
                            <option value="barcode">Create barcode</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <!-- mass action dropdown end -->

                    <div>
                        <button
                            class="inline-flex px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md cursor-pointer text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                            @click="sendAction()"
                        >
                            Send
                        </button>
                    </div>

                    <DeleteModal
                        :checkedTransactions="checkedTransactions"
                        :deleteProps="deleteProps"
                        @close="close"
                        v-if="isDelete"
                    />
                </div>
            </div>
            <!-- transaction items -->
            <table class="my-4 mx-3 bg-white rounded-md">
                <thead class="border-b table-auto">
                    <tr class="font-semibold tracking-wide text-left">
                        <th
                            class="text-sm font-medium text-gray-600 px-5 mr-1 py-1"
                            scope="col"
                        >
                            <input
                                @click="checkAll()"
                                type="checkbox"
                                name=""
                                id=""
                            />
                        </th>

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
                        <th
                            class="text-sm font-medium text-gray-600 py-1 px-5 hidden"
                            scope="col"
                        >
                            Options
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="item in filterLists"
                        :key="item.index"
                        class="py-3 border-b border-gray-background mr-2"
                    >
                        <td class="lg:table-cell px-5">
                            <label
                                class=" text-center-4 border-2"
                                :for="item.id"
                            ></label>
                            <input
                                :checked="isChecked"
                                type="checkbox"
                                :name="item.id"
                                :value="item.id"
                                :id="item.id"
                                v-model="checkedTransactions"
                            />
                        </td>

                        <td class=" w-auto md:w-2/5 lg:w-2/3">
                            <div
                                class="py-4 px-6 flex  flex-col lg:flex-row items-center lg:space-x-2 space-y-1"
                            >
                                <td v-if="item.images.length > 0" class=" ">
                                    <img
                                        :src="item.images[0].url"
                                        alt=""
                                        width="50"
                                        height="40"
                                    />
                                </td>

                                <td v-else class="h-20 w-20 pt-4">
                                    <img
                                        src="../../../assets/placeholder.png"
                                        alt=""
                                    />
                                </td>

                                <td class="text-gray-darken text-sm">
                                    Comments:
                                    <span class="text-black font-medium">{{
                                        item.comments
                                    }}</span>
                                </td>
                            </div>
                        </td>

                        <td class="flex flex-col lg:flex-row ">
                            <!-- trans info -->
                            <div class="pb-4 pt-6 px-6 flex flex-col">
                                <td class="text-purple-darken font-bold">
                                    <inertia-link
                                        :href="`/admin/transactions/${item.id}`"
                                    >
                                        <span
                                            class="text-indigo-700 cursor-pointer"
                                            >Transaction #{{ item.id }}</span
                                        >
                                    </inertia-link>
                                </td>
                                <td class="text-gray-darken text-xs">
                                    {{ item.created_at }}
                                </td>
                                <td class="text-black font-medium">
                                    {{ item.customer.first_name }}
                                    {{ item.customer.last_name }}
                                </td>
                                <td
                                    v-if="!item.customer.state"
                                    class="text-black font-medium"
                                >
                                    {{ item.customer.city }}
                                </td>
                                <td v-else class="text-black font-medium">
                                    {{ item.customer.city }},
                                    {{ item.customer.state.code }}
                                </td>

                                <td class="flex flex-row space-x-1">
                                    <MailIcon class="h-5 w-5" />
                                    <PhoneIcon class="h-5 w-5" />
                                </td>

                                <td class="lg:hidden">
                                    <div class="py-4 w-24 flex flex-col ">
                                        <button
                                            class="bg-purple-darken py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken"
                                            type="submit"
                                        >
                                            Send Kit
                                        </button>
                                    </div>
                                </td>
                            </div>
                        </td>

                        <!-- options column start-->
                        <td class="hidden lg:table-cell">
                            <div class="py-4 mr-8 w-24 flex flex-col">
                                <button
                                    class="bg-purple-darken py-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken"
                                    type="submit"
                                >
                                    Send Kit
                                </button>
                            </div>
                        </td>

                        <!-- options column end -->
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <pagination
                class="mx-3"
                :meta="pagination"
                v-if="pagination.total > pagination.per_page"
            />
        </div>
    </app-layout>
</template>
<script>
import { ref, reactive, computed, onMounted } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import axios from 'axios'
import { SearchIcon, PlusIcon } from '@heroicons/vue/solid'
import { MailIcon, PhoneIcon } from '@heroicons/vue/outline'
import Pagination from '../../Components/Pagination.vue'
import { Inertia } from '@inertiajs/inertia'
import DeleteModal from '../../Components/DeleteModal.vue'
import notification from '../../Utils/notification'
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
        PlusIcon,
        PhoneIcon,
        Pagination,
        DeleteModal
    },
    props: {
        notifications: Array,
        transactions: Object,
        navigation: Array
    },
    setup ({ navigation, transactions }) {
        const { onClickTop, onClickBot } = notification()
        const imageExists = ref(true)
        const loading = false
        const isChecked = ref(false)
        const notifications = notifications
        const pagination = ref(transactions)
        const filterLists = ref(transactions.data)
        const massActionChoice = ref('choose')
        const isDelete = ref(false)
        const deleteProps = reactive({
            url: '/admin/transactions/delete',
            item: 'Transactions'
        })
        const checkedTransactions = ref([])

        onMounted(() => {
            // this.$emit('doNavigation', navigation)
        })

        function success (list, page) {
            filterLists.value = list
            pagination.value = page
            loading.value = false
        }

        function checkAll () {
            isChecked.value = !isChecked.value
        }

        function sendAction () {
            let data = {
                transactions: checkedTransactions.value,
                action: massActionChoice.value
            }
            switch (massActionChoice.value) {
                case 'delete':
                    isDelete.value = true
                    break
                case 'label_to':
                case 'label_from':
                case 'barcode':
                    Inertia.post(
                        '/admin/transactions/bulk-actions/barcode',
                        data
                    )
                    break
            }
        }

        function close () {
            isDelete.value = false
            Inertia.visit('/admin/transactions', {
                method: 'get'
            })
        }

        return {
            loading,
            transactions,
            statusStyles,
            pagination,
            filterLists,
            imageExists,
            isChecked,
            checkAll,
            massActionChoice,
            sendAction,
            isDelete,
            deleteProps,
            close,
            checkedTransactions
        }
    }
}
</script>
