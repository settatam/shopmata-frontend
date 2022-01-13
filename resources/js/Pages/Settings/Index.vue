<template>
    <!-- FONT AWESOME LINK -->
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous"
    />
    <!-- FONT AWESOME LINK -->
    <app-layout>
        <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
            <!-- Breadcrumb -->
            <div class="flex-shrink-0 mb-3 px-6 flex items-center">
                <p class="text-2xl font-semibold text-gray-900">Settings</p>
            </div>
            <nav class="flex px-6" aria-label="Breadcrumb">
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

            <div
                class="flex-1 flex flex-col xl:overflow-hidden lg:flex-row mt-5 px-4 lg:px-0"
            >
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
                                <label
                                    class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                >
                                    Store Name
                                </label>
                                <input
                                    type="text"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    v-model="store_details.name"
                                    required
                                />
                                <error-icon
                                    class="absolute top-11 right-2.5"
                                    v-show="storeNameError"
                                />
                            </div>
                            <div class="flex required mb-4">
                                <div class="mr-2 w-full">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Email Address
                                    </label>
                                    <input
                                        type="email"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        v-model="store_details.account_email"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="storeAccountEmailError"
                                    />
                                </div>
                                <div class="ml-2 w-full">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Sender Email
                                    </label>
                                    <input
                                        type="email"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        v-model="store_details.customer_email"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="storeCustomerEmailError"
                                    />
                                </div>
                            </div>
                            <div class="required w-full mb-4">
                                <label
                                    class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    for="industry"
                                >
                                    Store Industry
                                </label>
                                <select
                                    id="industry"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    v-model="store_details.industry_id"
                                    required
                                >
                                    <option value="">Choose Industry</option>
                                    <option
                                        v-for="(industry, index) in industries"
                                        :key="index"
                                        :value="industry.id"
                                    >
                                        {{ industry.name }}
                                    </option>
                                </select>
                                <error-icon
                                    class="absolute top-11 right-2.5"
                                    v-show="storeIndustryIdError"
                                />
                            </div>
                            <div
                                class="border-t border-gray-300 mt-6 mb-5 -mx-8"
                            ></div>
                            <h2 class="text-lg font-semibold mb-2">
                                Store Address
                            </h2>
                            <p class="w-full text-gray-400 mb-4">
                                This address will appear on your invoices. You
                                can edit the address used to calculate shipping
                                rates in your
                                <inertia-link
                                    href="/settings/shipping-and-delivery"
                                >
                                    <span class="text-indigo-700 cursor-pointer"
                                        >shipping settings</span
                                    >
                                </inertia-link>
                            </p>
                            <div class="required w-full mb-4">
                                <label
                                    class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                >
                                    Legal Name of Business
                                </label>
                                <input
                                    type="text"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    v-model="store_details.business_name"
                                    required
                                />
                                <error-icon
                                    class="absolute top-11 right-2.5"
                                    v-show="storeBusinessNameError"
                                />
                            </div>
                            <div class="required w-full mb-4">
                                <label
                                    class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                >
                                    Phone Number
                                </label>
                                <input
                                    type="tel"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    v-model="store_details.phone"
                                    required
                                />
                                <error-icon
                                    class="absolute top-11 right-2.5"
                                    v-show="storePhoneError"
                                />
                            </div>
                            <div class="required w-full mb-4">
                                <label
                                    class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                >
                                    Country
                                </label>
                                <select
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    v-model="store_details.country_id"
                                    required
                                >
                                    <option
                                        v-for="(country, index) in this
                                            .countries"
                                        :key="index"
                                        :value="country.id"
                                    >
                                        {{ country.name }}
                                    </option>
                                </select>
                                <error-icon
                                    class="absolute top-11 right-2.5"
                                    v-show="storeCountryIdError"
                                />
                            </div>
                            <div class="flex required mb-4">
                                <div class="mr-2 w-full">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        City
                                    </label>
                                    <input
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        v-model="store_details.city"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="storeCityError"
                                    />
                                </div>
                                <div class="mx-2 w-full">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        State
                                    </label>
                                    <select
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        v-model="store_details.state_id"
                                        required
                                    >
                                        <option value="">Choose a State</option>
                                        <option
                                            v-for="(
                                                state, index
                                            ) in country_state"
                                            :key="index"
                                            :value="state.id"
                                        >
                                            {{ state.name }}
                                        </option>
                                    </select>
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="storeStateError"
                                    />
                                </div>
                                <div class="mr-2 w-full">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        ZIP / Postal Code
                                    </label>
                                    <input
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        v-model="store_details.zip"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="storeZipError"
                                    />
                                </div>
                            </div>

                            <div
                                class="border-t border-gray-300 mt-6 mb-5 -mx-8"
                            ></div>
                            <h2 class="text-lg font-semibold mb-2">
                                Standards and Formats
                            </h2>
                            <p class="w-full text-gray-400 mb-4">
                                Standards and formats are used to calculate
                                product prices, shipping weights, and order
                                times.
                            </p>
                            <div class="required w-full mb-4">
                                <label
                                    class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                >
                                    Time Zone
                                </label>
                                <select
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    v-model="store_details.timezone_id"
                                    required
                                >
                                    <option value="0">Select Timezone</option>
                                    <option
                                        v-for="(timezone, index) in timezones"
                                        :key="index"
                                        :value="timezone.id"
                                    >
                                        {{ timezone.text }}
                                    </option>
                                </select>
                                <error-icon
                                    class="absolute top-11 right-2.5"
                                    v-show="storeTimeZoneError"
                                />
                            </div>
                            <div class="flex required mb-4">
                                <div class="mr-2 w-full">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Unit System
                                    </label>
                                    <select
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        v-model="store_details.unit_id"
                                        required
                                    >
                                        <option
                                            v-for="(unit, index) in units"
                                            :key="index"
                                            :value="unit.id"
                                        >
                                            {{ unit.unit }}
                                        </option>
                                    </select>
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="storeUnitError"
                                    />
                                </div>
                                <div class="ml-2 w-full">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Default Weight Unit
                                    </label>
                                    <input
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        v-model="
                                            store_details.default_weight_unit
                                        "
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="storeWeightError"
                                    />
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
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Prefix
                                    </label>
                                    <input
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        v-model="store_details.order_id_prefix"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="storePrefixError"
                                    />
                                </div>
                                <div class="ml-2 w-full">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Suffix
                                    </label>
                                    <input
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder=""
                                        v-model="store_details.order_id_suffix"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="storeSuffixError"
                                    />
                                </div>
                            </div>
                            <div
                                class="border-t border-gray-300 mt-6 mb-5 -mx-8"
                            ></div>
                            <h2 class="text-lg font-semibold mb-2">
                                Store Currency
                            </h2>
                            <p class="w-full text-gray-400 mb-4">
                                Standards and formats are used to calculate
                                product prices, shipping weights, and order
                                times.
                            </p>
                            <div class="required w-full mb-4">
                                <label
                                    class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                >
                                    Store Currency
                                </label>
                                <select
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder=""
                                    v-model="store_details.currency_id"
                                    required
                                >
                                    <option
                                        v-for="(currency, index) in currencies"
                                        :key="index"
                                        :value="currency.id"
                                    >
                                        {{ currency.symbol_left + " " }}
                                        {{ currency.title }} ({{
                                            currency.code
                                        }})
                                    </option>
                                </select>
                                <!-- <p class="w-full text-gray-400 mb-4">You have made your first sale, so you need to 
                      <inertia-link href="/settings/contact">
                        <span class="text-indigo-700 cursor-pointer" >contact support</span> 
                      </inertia-link>
                    if you want to change your currency</p> -->
                                <error-icon
                                    class="absolute top-11 right-2.5"
                                    v-show="storeCurrencyError"
                                />
                            </div>
                        </div>
                        <!-- <button class="text-white bg-indigo-700 rounded-md px-8 py-3 float-right my-5" @click="submit">Save Changes</button> -->
                        <div class="flex items-center mb-5">
                            <button
                                type="button"
                                class="rounded-md border border-transparent shadow-sm px-7 py-3 text-base font-medium text-white sm:text-sm"
                                :class="
                                    store_details.length > 1 &&
                                    store_details.length > 1
                                        ? 'bg-indigo-600'
                                        : 'bg-gray-400'
                                "
                                @click="submit"
                            >
                                <i
                                    class="fas fa-spinner fa-pulse text-white m-2"
                                    v-if="loading"
                                ></i
                                >{{ save }}
                            </button>
                        </div>
                        <error
                            v-if="error"
                            :msg="successMessage"
                            class="absolute top-2 w-full"
                        />
                        <success
                            v-if="success"
                            :msg="successMessage"
                            class="absolute top-2 w-full"
                        />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { ref, reactive, watch, onBeforeMount } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import Search from "../Search.vue";
import Nav from "./Nav";
import axios from "axios";
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
import { HomeIcon } from "@heroicons/vue/outline";
import { Inertia } from "@inertiajs/inertia";

const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};
const pages = [
    { name: "Settings", href: "/settings", current: false },
    { name: "General Information", href: "/settings/general", current: true },
];

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
    },

    components: {
        Nav,
        AppLayout,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        ChevronRightIcon,
        HomeIcon,
    },

    setup({ store, states }) {
        const open = ref(false);
        const state = ref(states);
        const country_state = ref({});
        const store_details = reactive(store);
        const message = ref("");
        const save = ref("Save Changes");
        const loading = ref(false);
        const success = ref(false);
        onBeforeMount(() => {
            country_state.value = state.value;
        });
        watch(store_details, (newVal) => {
            axios
                .get(`/api/states?country_id=${newVal.country_id}`)
                .then((res) => {
                    country_state.value = res.data.data;
                });
        });
        const submit = () => {
            Inertia.put("/store", store_details);
        };
        return {
            statusStyles,
            //store_details,
            //states,
            pages,
            state,
            country_state,
            store_details,
            submit,
            //updateStates
        };
    },
};
</script>
