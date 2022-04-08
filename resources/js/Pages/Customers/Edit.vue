<template>
    <!-- FONT AWESOME LINK -->
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous"
    />

    <app-layout>
        <!-- Breadcrumb -->
        <nav class="flex px-8 mt-8" aria-label="Breadcrumb">
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
                <ChevronRightIcon
                    class="flex-shrink-0 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
                <li>
                    <div>
                        <a
                            href="/customers"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            All Customers
                        </a>
                    </div>
                </li>
                <ChevronRightIcon
                    class="flex-shrink-0 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
                <li v-for="page in pages" :key="page.name">
                    <div class="flex items-center">
                        <a
                            :href="page.href"
                            class="mr-4 text-sm font-medium text-gray-400 hover:text-gray-500"
                            :aria-current="page.current ? 'page' : undefined"
                            >{{ page.name }}</a
                        >
                    </div>
                </li>
            </ol>
        </nav>
        <!-- Breadcrumb end -->

        <div class="flex justify-between items-center mx-8 mt-8">
            <div class="flex items-center">
                <h1 class="text-2xl font-semibold text-gray-800">
                    Edit Customer
                </h1>
            </div>
        </div>

        <!-- Main content -->
        <div class="w-11/12 lg:w-2/3 bg-white mt-7 mb-7 mx-auto rounded-md">
            <div class="p-8">
                <h2 class="text-xl font-semibold">Personal Information</h2>

                <div class="mb-4">
                    <div class="flex flex-col lg:flex-row">
                        <div class="required w-full mr-5 mt-4 relative">
                            <div>
                                <label
                                    class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                >
                                    First Name
                                </label>
                                <input
                                    :class="{
                                        'border-red-600': v$.first_name.$error,
                                        'border-gray-300': !v$.first_name.$error
                                    }"
                                    type="text"
                                    id="firstName"
                                    name="firstName"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    required
                                    v-model="customerEdits.first_name"
                                />
                            </div>

                            <div class="mt-1">
                                <p
                                    class="text-red-600 text-xs"
                                    v-if="v$.first_name.$error"
                                >
                                    {{ v$.first_name.$errors[0].$message }}
                                </p>
                            </div>
                        </div>

                        <div class="required w-full mt-4 relative">
                            <div>
                                <label
                                    class="block text-gray-600 font-semibold mb-1 bg-transparent"
                                >
                                    Last Name
                                </label>
                                <input
                                    :class="{
                                        'border-red-600': v$.last_name.$error,
                                        'border-gray-300': !v$.last_name.$error
                                    }"
                                    type="text"
                                    id="lastName"
                                    name="lastName"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    required
                                    v-model="customerEdits.last_name"
                                />
                            </div>

                            <div class="mt-1">
                                <p
                                    class="text-red-600 text-xs"
                                    v-if="v$.last_name.$error"
                                >
                                    {{ v$.last_name.$errors[0].$message }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="required w-full mr-5 mt-5 relative">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Email Address
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.email.$error,
                                    'border-gray-300': !v$.email.$error
                                }"
                                type="email"
                                id="email"
                                name="email"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="customerEdits.email"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.email.$error"
                            >
                                {{ v$.email.$errors[0].$message }}
                            </p>
                        </div>
                    </div>
                    <div class="required w-full mr-5 mt-5 relative">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Phone Number
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.phone_number.$error,
                                    'border-gray-300': !v$.phone_number.$error
                                }"
                                type="tel"
                                id="tel"
                                name="tel"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="customerEdits.phone_number"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.phone_number.$error"
                            >
                                {{ v$.phone_number.$errors[0].$message }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- divider start -->
                <div class="border-t-2 border-gray-300 my-7 -mx-8"></div>
                <!-- divider end -->

                <!-- address start -->
                <h2 class="text-xl font-semibold">Address</h2>

                <div class="required w-full mr-5 mt-5 relative">
                    <div>
                        <label
                            class="block text-gray-600 font-semibold mb-1 bg-transparent"
                        >
                            Address
                        </label>
                        <input
                            :class="{
                                'border-red-600': v$.address.$error,
                                'border-gray-300': !v$.address.$error
                            }"
                            type="text"
                            id="address"
                            name="address"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder=""
                            required
                            v-model="customerEdits.address"
                        />
                    </div>

                    <div class="mt-1">
                        <p
                            class="text-red-600 text-xs"
                            v-if="v$.address.$error"
                        >
                            {{ v$.address.$errors[0].$message }}
                        </p>
                    </div>
                </div>

                <div class="flex mt-4 flex-col lg:flex-row">
                    <div class="required w-full mr-5 relative">
                        <!-- put country here -->
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Country
                            </label>
                            <select
                                :class="{
                                    'border-red-600': v$.country_id.$error,
                                    'border-gray-300': !v$.country_id.$error
                                }"
                                id="country"
                                name="country"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="customerEdits.country_id"
                            >
                                <option value="">Choose a Country</option>
                                <option
                                    v-for="(country, index) in countries"
                                    :key="index"
                                    :value="country.id"
                                >
                                    {{ country.name }}
                                </option>
                            </select>
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.country_id.$error"
                            >
                                {{ v$.country_id.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div
                        class="required w-full mt-4 lg:mt-0 ml-0 lg:ml-5 relative"
                    >
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Apartment/Suite
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.apartment.$error,
                                    'border-gray-300': !v$.apartment.$error
                                }"
                                type="text"
                                id="apartment"
                                name="apartment"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="customerEdits.apartment"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.apartment.$error"
                            >
                                {{ v$.apartment.$errors[0].$message }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row mt-4">
                    <div class="required w-full">
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                State
                            </label>
                            <!-- state v-if start -->

                            <div v-if="states.length">
                                <select
                                    id="state"
                                    name="state"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    required
                                    v-model="customerEdits.state_id"
                                    :class="{
                                        'border-red-600': v$.state_id.$error,
                                        'border-gray-300': !v$.state_id.$error
                                    }"
                                >
                                    <option value="">Choose a State</option>
                                    <option
                                        v-for="(state, index) in states[0]
                                            .states"
                                        :key="index"
                                        :value="state.id"
                                    >
                                        {{ state.name }}
                                    </option>
                                </select>
                            </div>

                            <!-- state v-if end -->
                            <!-- v-else -->
                            <div v-else>
                                <select
                                    :class="{
                                        'border-red-600': v$.state_id.$error,
                                        'border-gray-300': !v$.state_id.$error
                                    }"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    v-model="customerEdits.state_id"
                                    required
                                >
                                    <option value="null">Select State</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.state_id.$error"
                            >
                                {{ v$.state_id.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div
                        class="required w-full mt-4 lg:mt-0 ml-0 lg:ml-5 relative"
                    >
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                City
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.city.$error,
                                    'border-gray-300': !v$.city.$error
                                }"
                                type="text"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="customerEdits.city"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.city.$error"
                            >
                                {{ v$.city.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <div
                        class="required w-full mt-4 lg:mt-0 ml-0 lg:ml-5 relative"
                    >
                        <div>
                            <label
                                class="block text-gray-600 font-semibold mb-1 bg-transparent"
                            >
                                Zip/Postal Code
                            </label>
                            <input
                                :class="{
                                    'border-red-600': v$.zip.$error,
                                    'border-gray-300': !v$.zip.$error
                                }"
                                type="text"
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder=""
                                required
                                v-model="customerEdits.zip"
                            />
                        </div>

                        <div class="mt-1">
                            <p
                                class="text-red-600 text-xs"
                                v-if="v$.zip.$error"
                            >
                                {{ v$.zip.$errors[0].$message }}
                            </p>
                        </div>
                    </div>

                    <!-- address ends -->
                </div>
            </div>
        </div>

        <div class="flex justify-between w-2/3 mx-auto mb-9">
            <div class="">
                <inertia-link href="/customers">
                    <button
                        class="text-gray-400 bg-gray-100 border border-gray-400 rounded-md px-6 py-3"
                    >
                        Cancel
                    </button>
                </inertia-link>
            </div>
            <div class="">
                <button
                    v-if="!v$.$error"
                    :disabled="loading"
                    type="submit"
                    :class="{
                        disabled: loading,
                        'opacity-25 cursor-not-allowed': loading
                    }"
                    class="disabled:bg-gray-400  bg-indigo-600 text-white rounded-md px-8 py-3"
                    @click="submit"
                >
                    <LoadingSpinner v-if="loading" />
                    Save
                </button>

                <!-- else -->
                <button
                    v-else
                    type="button"
                    class="bg-indigo-600 text-white rounded-md px-8 py-3"
                >
                    Save
                </button>

                <NotificationGroup group="top" position="top">
                    <div
                        class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none"
                    >
                        <div class="w-full max-w-sm">
                            <Notification
                                v-slot="{ notifications, close }"
                                enter="transform ease-out duration-300 transition"
                                enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                                enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                                leave="transition ease-in duration-500"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                                move="transition duration-500"
                                move-delay="delay-300"
                            >
                                <div
                                    class="w-full max-w-sm mt-4 overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5"
                                    v-for="notification in notifications"
                                    :key="notification.id"
                                >
                                    <div class="p-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <svg
                                                    class="w-6 h-6 text-green-400"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                    />
                                                </svg>
                                            </div>
                                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                                <p
                                                    class="font-semibold text-gray-800"
                                                >
                                                    {{ notification.title }}
                                                </p>
                                                <p
                                                    class="text-sm font-semibold text-gray-500"
                                                >
                                                    {{ notification.text }}
                                                </p>
                                            </div>
                                            <div
                                                class="flex flex-shrink-0 ml-4"
                                            >
                                                <button
                                                    @click="
                                                        close(notification.id)
                                                    "
                                                    class="inline-flex text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
                                                >
                                                    <span class="sr-only"
                                                        >Close</span
                                                    >
                                                    <svg
                                                        class="w-5 h-5"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                        aria-hidden="true"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
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
                        class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none"
                    >
                        <div class="w-full max-w-sm">
                            <Notification
                                v-slot="{ notifications }"
                                enter="transform ease-out duration-300 transition"
                                enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                                enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                                leave="transition ease-in duration-500"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                                move="transition duration-500"
                                move-delay="delay-300"
                            >
                                <div
                                    class="flex w-full max-w-sm mx-auto mt-4 overflow-hidden bg-white rounded-lg shadow-md"
                                    v-for="notification in notifications"
                                    :key="notification.id"
                                >
                                    <div
                                        class="flex items-center justify-center w-12 bg-red-500"
                                    >
                                        <svg
                                            class="w-6 h-6 text-white fill-current"
                                            viewBox="0 0 40 40"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"
                                            ></path>
                                        </svg>
                                    </div>

                                    <div class="px-4 py-2 -mx-3">
                                        <div class="mx-3">
                                            <span
                                                class="font-semibold text-red-500"
                                                >{{ notification.title }}</span
                                            >
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
    </app-layout>
</template>

<script>
import { ref, reactive, computed, onBeforeMount } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import axios from 'axios'
import LoadingSpinner from '../../Components/LoadingSpinner.vue'
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot
} from '@headlessui/vue'
import { ChevronRightIcon } from '@heroicons/vue/solid'
import { HomeIcon } from '@heroicons/vue/outline'
import { Inertia } from '@inertiajs/inertia'
import { notify } from 'notiwind'
import {
    required,
    maxLength,
    numeric,
    helpers,
    email
} from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'

const pages = [
    { name: 'Edit Customer', href: '/customers/edit', current: false }
]
const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}
export default {
    props: ['customer', 'countries', 'notification'],

    components: {
        AppLayout,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        ChevronRightIcon,
        HomeIcon,
        LoadingSpinner
    },

    setup (props) {
        const customer = props.customer
        const loading = ref(false)
        const countries = props.countries
        const states = computed(() => {
            return countries.filter(
                country => country.id == customerEdits.country_id
            )
        })
        const splitNameFirst = computed(() => {
            return customer.first_name
                .split(' ')
                .slice(0, -1)
                .join(' ')
        })

        const splitNameLast = computed(() => {
            return customer.first_name
                .split(' ')
                .slice(-1)
                .join(' ')
        })

        const customerEdits = reactive({
            // first_name: splitNameFirst,
            // last_name: splitNameLast,
            first_name: customer.first_name,
            last_name: customer.last_name,
            email: customer.email,
            phone_number: customer.phone_number,
            address: customer.address,
            apartment: customer.apartment,
            country_id: customer.country_id,
            state_id: customer.state_id,
            city: customer.city,
            zip: customer.zip
        })


        const rules = computed(() => {
            return {
                first_name: {
                    required: helpers.withMessage(
                        'Enter a first name',
                        required
                    )
                },
                last_name: {
                    required: helpers.withMessage('Enter a last name', required)
                },
                email: {
                    required: helpers.withMessage(
                        'Please enter an email address',
                        required
                    ),
                    email
                },
                phone_number: {
                    required: helpers.withMessage(
                        'Enter a phone number',
                        required
                    )
                },
                address: {
                    required: helpers.withMessage('Enter an address', required)
                },
                apartment: {
                    required: helpers.withMessage(
                        'Enter an apartment',
                        required
                    )
                },
                country_id: {
                    required: helpers.withMessage('Select a country', required)
                },
                state_id: {
                    required: helpers.withMessage('Select a state', required)
                },
                city: {
                    required: helpers.withMessage('Enter a city', required)
                },
                zip: {
                    required: helpers.withMessage(
                        'Enter a postal code',
                        required
                    )
                }
            }
        })

        const v$ = useVuelidate(rules, customerEdits)

        function submit () {
            this.v$.$validate()
            if (this.v$.$error) {
                return
            }
            loading.value = true
            Inertia.put(`/customers/${customer.id}`, customerEdits)
            Inertia.visit('/customers', { method: 'get' })
        }

        return {
            pages,
            v$,
            statusStyles,
            submit,
            states,
            loading,
            submit,
            customer,
            customerEdits,
            splitNameFirst,
            splitNameLast,
            countries
        }
    }
}
</script>
