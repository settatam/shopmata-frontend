<template>
    <!-- FONT AWESOME LINK -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous" />
    <!-- FONT AWESOME LINK -->
    <app-layout :navigation="navigation">
        <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
            <!-- Breadcrumb -->
            <div class="flex-shrink-0 mb-3 px-6 flex items-center">
                <p class="text-2xl font-semibold text-gray-900">Settings</p>
            </div>
            <nav class="flex px-6" aria-label="Breadcrumb">
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

            <div class="flex-1 flex flex-col xl:overflow-hidden lg:flex-row mt-5 px-4 lg:px-0">
                <!-- Secondary sidebar -->
                <Nav page="General"></Nav>
                <!-- Main content -->
                <div class="flex-1 max-h-screen xl:overflow-y-auto">
                    <div class="w-auto lg:ml-7 lg:mr-2">
                        <div class="p-8 bg-white">
                            <h1 class="text-2xl mb-2 font-semibold">
                                General information
                            </h1>
                            <h2 class="text-lg font-semibold mb-9">
                                Store Details
                            </h2>
                            <div class="required w-full mb-4">
                                <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                    Store Name
                                </label>
                                <input type="text"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="store_details.name" required />
                            </div>
                            <div class="flex required mb-4">
                                <div class="mr-2 w-full">
                                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                        Email Address
                                    </label>
                                    <input type="email"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="" v-model="store_details.account_email" required />
                                </div>
                                <div class="ml-2 w-full">
                                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                        Sender Email
                                    </label>
                                    <input type="email"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="" v-model="store_details.customer_email" required />
                                </div>
                            </div>
                            <div class="required w-full mb-4">
                                <label class="block text-gray-600 font-semibold mb-2 bg-transparent" for="industry">
                                    Store Industry
                                </label>
                                <select id="industry"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="store_details.industry_id" required>
                                    <option value="">Choose Industry</option>
                                    <option v-for="(industry, index) in industries" :key="index" :value="industry.id">
                                        {{ industry.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="border-t border-gray-300 mt-6 mb-5 -mx-8"></div>
                            <h2 class="text-lg font-semibold mb-2">
                                Store Address
                            </h2>
                            <p class="w-full text-gray-400 mb-4">
                                This address will appear on your invoices. You
                                can edit the address used to calculate shipping
                                rates in your
                                <inertia-link href="/settings/shipping-and-delivery">
                                    <span class="text-indigo-700 cursor-pointer">shipping settings</span>
                                </inertia-link>
                            </p>

                            <div class="required w-full mb-4">
                                <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                  Address
                                </label>
                                <input type="text"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="store_details.address" required />
                            </div>

                             <div class="required w-full mb-4">
                                <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                    Address 2 
                                </label>
                                <input type="text"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="store_details.address2" required />
                            </div>
                            <div class="required w-full mb-4">
                                <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                    Legal Name of Business
                                </label>
                                <input type="text"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="store_details.business_name" required />
                            </div>
                            <div class="required w-full mb-4">
                                <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                    Phone Number
                                </label>
                                <input type="tel"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="store_details.phone" required />
                            </div>
                            <div class="required w-full mb-4">
                                <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                    Country
                                </label>
                                <select
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="store_details.country_id" required>
                                    <option  :value="countries.id">
                                        {{ countries.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="flex required mb-4">
                                <div class="mr-2 w-full">
                                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                        City
                                    </label>
                                    <input type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="" v-model="store_details.city" required />
                                </div>
                                <div class="mx-2 w-full">
                                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                        State
                                    </label>
                                    <select
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="" v-model="store_details.state_id" required>
                                        <option value="">Choose a State</option>
                                        <option v-for="(state,
                                        index) in states" :key="index" :value="state.id">
                                            {{ state.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mr-2 w-full">
                                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                        ZIP / Postal Code
                                    </label>
                                    <input type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="" v-model="store_details.zip" required />
                                </div>
                            </div>

                            <div class="border-t border-gray-300 mt-6 mb-5 -mx-8"></div>
                            <h2 class="text-lg font-semibold mb-2">
                                Standards and Formats
                            </h2>
                            <p class="w-full text-gray-400 mb-4">
                                Standards and formats are used to calculate
                                product prices, shipping weights, and order
                                times.
                            </p>
                            <div class="required w-full mb-4">
                                <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                    Time Zone
                                </label>
                                <select
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="store_details.timezone_id" required>
                                    <option value="0">Select Timezone</option>
                                    <option v-for="(timezone, index) in timezones" :key="index" :value="timezone.id">
                                        {{ timezone.text }}
                                    </option>
                                </select>
                            </div>
                            <div class="flex required mb-4">
                                <div class="mr-2 w-full">
                                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                        Unit System
                                    </label>
                                    <select
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="" v-model="store_details.unit_id" required>
                                        <option v-for="(unit, index) in units" :key="index" :value="unit.id">
                                            {{ unit.unit }}
                                        </option>
                                    </select>
                                </div>
                                <div class="ml-2 w-full">
                                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                        Default Weight Unit
                                    </label>
                                    <input type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="" v-model="
                                            store_details.default_weight_unit
                                        " required />
                                </div>
                            </div>
                            <h2 class="text-lg font-semibold mb-2">
                                Edit Order ID Format (Optional)
                            </h2>
                            <p class="w-full text-gray-400 mb-4">
                                Standards and formats are used to calculate
                                product prices, shipping weights, and order
                                times.
                            </p>
                            <div class="flex required mb-4">
                                <div class="mr-2 w-full">
                                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                        Prefix
                                    </label>
                                    <input type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="" v-model="store_details.order_id_prefix" required />
                                </div>
                                <div class="ml-2 w-full">
                                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                        Suffix
                                    </label>
                                    <input type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="" v-model="store_details.order_id_suffix" required />
                                </div>
                            </div>
                            <div class="border-t border-gray-300 mt-6 mb-5 -mx-8"></div>
                            <h2 class="text-lg font-semibold mb-2">
                                Store Currency
                            </h2>
                            <p class="w-full text-gray-400 mb-4">
                                Standards and formats are used to calculate
                                product prices, shipping weights, and order
                                times.
                            </p>
                            <div class="required w-full mb-4">
                                <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                    Store Currency
                                </label>
                                <select
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="store_details.currency_id" required>
                                    <option value="">Choose currency</option>
                                    <option v-for="(currency, index) in currencies" :key="index" :value="currency.id">
                                        {{ currency.symbol_left + ' ' }}
                                        {{ currency.title }} ({{
                                                currency.code
                                        }})
                                    </option>
                                </select>
                            </div>
                            <!-- sms and email -->

                            <div class="border-t border-gray-300 mt-6 mb-5 -mx-8"></div>
                            <h2 class="text-lg font-semibold mb-2">
                                Sender Email/Phone number
                            </h2>
                            <p class="w-full text-gray-400 mb-4">
                                Choose what phone number or Email you would like to send messages from.
                            </p>
                            <div class="required w-full mb-4">
                                <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                    Send SMS from*
                                </label>
                                <input type="tel"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="store_details.phone" required />
                            </div>

                            <div class="required w-full mb-4">
                                <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                                    Send Email from*
                                </label>
                                <input type="tel"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="" v-model="store_details.customer_email" required />
                            </div>
                        </div>
                        <button class="text-white rounded-md px-8 py-3 float-right my-5"
                            :class="loading ? 'bg-gray-400' : 'bg-indigo-600'" @click="submit" :disabled="loading">
                            <i class="fas fa-spinner fa-pulse text-white m-1" v-if="loading"></i>{{ save }}
                        </button>
                        <NotificationGroup group="top" position="top">
                            <div
                                class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none">
                                <div class="w-full max-w-sm">
                                    <Notification v-slot="{ notifications, close }"
                                        enter="transform ease-out duration-300 transition"
                                        enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                                        enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                                        leave="transition ease-in duration-500" leave-from="opacity-100"
                                        leave-to="opacity-0" move="transition duration-500" move-delay="delay-300">
                                        <div class="w-full max-w-sm mt-4 overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5"
                                            v-for="notification in notifications" :key="notification.id">
                                            <div class="p-4">
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-green-400"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor"
                                                            aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </div>
                                                    <div class="ml-3 w-0 flex-1 pt-0.5">
                                                        <p class="font-semibold text-gray-800">
                                                            {{
                                                                    notification.title
                                                            }}
                                                        </p>
                                                        <p class="text-sm font-semibold text-gray-500">
                                                            {{
                                                                    notification.text
                                                            }}
                                                        </p>
                                                    </div>
                                                    <div class="flex flex-shrink-0 ml-4">
                                                        <button @click="
                                                            close(
                                                                notification.id
                                                            )
                                                        "
                                                            class="inline-flex text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                                            <span class="sr-only">Close</span>
                                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 20 20" fill="currentColor"
                                                                aria-hidden="true">
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
                            <div
                                class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none">
                                <div class="w-full max-w-sm">
                                    <Notification v-slot="{ notifications }"
                                        enter="transform ease-out duration-300 transition"
                                        enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                                        enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                                        leave="transition ease-in duration-500" leave-from="opacity-100"
                                        leave-to="opacity-0" move="transition duration-500" move-delay="delay-300">
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
                                                    <span class="font-semibold text-red-500">{{
                                                            notification.title
                                                    }}</span>
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
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { ref, reactive, watch, onBeforeMount } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import Search from '../Search.vue'
import Nav from './Nav'
import axios from 'axios'
import { notify } from 'notiwind'
import notification from "../../Utils/notification";

import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot
} from '@headlessui/vue'
import { ChevronRightIcon } from '@heroicons/vue/solid'
import { HomeIcon } from '@heroicons/vue/outline'
import { Inertia } from '@inertiajs/inertia'
import { FLIPPED_ALIAS_KEYS } from '@babel/types'

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}
const pages = [
    { name: 'Settings', href: '/settings', current: false },
    { name: 'General Information', href: '/settings/general', current: true }
]

export default {
    props: {
        store: Object,
        countries: Array,
        currencies: Array,
        units: Array,
        industries: Array,
        timezones: Array,
        errors: Object,
        states: Array,
        navigation: Array,
    },
    components: {
        Nav,
        AppLayout,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        ChevronRightIcon,
        HomeIcon
    },


    setup({ store, states }) {
        const open = ref(false)
        const state = ref(states)
        const country_state = ref({})
        const save = ref('Save Changes')
        const loading = ref(false)
        const successMessage = ref('')
        const { notifyAlert } = notification();


        const store_details = reactive({
            name: store.name,
            account_email: store.account_email,
            customer_email: store.customer_email,
            phone: null != store.store_address ? store.store_address.phone : null,
            industry_id: store.industry_id,
            address: null != store.store_address ? store.store_address.address : null ,
            address2: null != store.store_address ? store.store_address.address2 : null ,
            country_id: null != store.store_address ? store.store_address.country_id : 1,
            city: null != store.store_address ? store.store_address.city : null ,
            zip: null != store.store_address ? store.store_address.zip : null ,
            state_id: null != store.store_address ? store.store_address.state_id: "",
            default_weight_unit: store.default_weight_unit,
            order_id_suffix: store.order_id_suffix,
            unit_id:  store.unit_id,
            currency_id:  store.currency_id || "",
            timezone_id: store.timezone_id

        })

        
        
        const loadingFn = () => {
            loading.value = false
            save.value = 'Save Changes'
        }
        const errorFn = () => {
            loading.value = false
            save.value = 'Save Changes'
        }
        onBeforeMount(() => {
            country_state.value = state.value
        })
        // watch(store_details, newVal => {
        //     axios
        //         .get(`/api/states?country_id=${newVal.country_id}`)
        //         .then(res => {
        //             country_state.value = res.data.data
        //         })
        // })
        const submit = () => {
            loading.value = true
            axios.patch('/admin/stores/' + store.id, store_details).then(res => {
                loading.value = false
                setTimeout(
                    notifyAlert(
                        "Settings updated successfully",
                        "top",
                        "Success"
                    ),
                    2000
                );
            }).catch(() => {
                loading.value = false
                setTimeout(
                    notifyAlert(
                        "Error processing your request",
                        "bottom",
                        "Error"
                    ),
                    2000
                );
            })
        }
        return {
            statusStyles,
            pages,
            state,
            save,
            successMessage,
            country_state,
            store_details,
            submit,
            loading,
            
        }
    }
}
</script>
