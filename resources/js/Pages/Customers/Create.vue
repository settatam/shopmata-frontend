<template>
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
                            class="
                                mr-4
                                text-sm
                                font-medium
                                text-gray-400
                                hover:text-gray-500
                            "
                            :aria-current="page.current ? 'page' : undefined"
                            >{{ page.name }}</a
                        >
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex justify-between items-center mx-8 mt-8">
            <div class="flex items-center">
                <h1 class="text-2xl font-semibold text-gray-800">
                    Add Customer
                </h1>
            </div>
        </div>

        <!-- Main content -->
        <div class="w-1/2 min-h-screen bg-white mt-7 mb-7 mx-auto rounded-sm">
            <div class="p-8">
                <h2 class="text-xl font-semibold">Personal Information</h2>
                <div class="flex mt-4">
                    <div class="required w-full mr-5">
                        <label
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-1
                                bg-transparent
                            "
                        >
                            First Name
                        </label>
                        <input
                            type="text"
                            id="firstName"
                            name="firstName"
                            class="
                                shadow-sm
                                focus:ring-indigo-500 focus:border-indigo-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                                rounded-md
                            "
                            placeholder=""
                            required
                            v-model="personal_info.first_name"
                        />
                    </div>
                    <div class="required w-full ml-5">
                        <label
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-1
                                bg-transparent
                            "
                        >
                            Last Name
                        </label>
                        <input
                            type="text"
                            id="lastName"
                            name="lastName"
                            class="
                                shadow-sm
                                focus:ring-indigo-500 focus:border-indigo-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                                rounded-md
                            "
                            placeholder=""
                            required
                            v-model="personal_info.last_name"
                        />
                    </div>
                </div>
                <div class="required w-full mr-5 mt-5">
                    <label
                        class="
                            block
                            text-gray-600
                            font-semibold
                            mb-1
                            bg-transparent
                        "
                    >
                        Email Address
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="
                            shadow-sm
                            focus:ring-indigo-500 focus:border-indigo-500
                            block
                            w-full
                            sm:text-sm
                            border-gray-300
                            rounded-md
                        "
                        placeholder=""
                        required
                        v-model="personal_info.email"
                    />
                </div>
                <div class="required w-full mr-5 mt-5">
                    <label
                        class="
                            block
                            text-gray-600
                            font-semibold
                            mb-1
                            bg-transparent
                        "
                    >
                        Phone Number
                    </label>
                    <input
                        type="tel"
                        id="tel"
                        name="tel"
                        class="
                            shadow-sm
                            focus:ring-indigo-500 focus:border-indigo-500
                            block
                            w-full
                            sm:text-sm
                            border-gray-300
                            rounded-md
                        "
                        placeholder=""
                        required
                        v-model="personal_info.phone"
                    />
                </div>
                <div class="border-t-2 border-gray-300 mt-6 mb-7 -mx-8"></div>
                <h2 class="text-xl font-semibold">Address</h2>
                <div class="flex mt-4">
                    <div class="required w-full mr-5">
                        <label
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-1
                                bg-transparent
                            "
                        >
                            First Name
                        </label>
                        <input
                            type="text"
                            id="firstName"
                            name="firstName"
                            class="
                                shadow-sm
                                focus:ring-indigo-500 focus:border-indigo-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                                rounded-md
                            "
                            placeholder=""
                            required
                            v-model="address_info.first_name"
                        />
                    </div>
                    <div class="required w-full ml-5">
                        <label
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-1
                                bg-transparent
                            "
                        >
                            Last Name
                        </label>
                        <input
                            type="text"
                            id="lastName"
                            name="lastName"
                            class="
                                shadow-sm
                                focus:ring-indigo-500 focus:border-indigo-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                                rounded-md
                            "
                            placeholder=""
                            required
                            v-model="address_info.last_name"
                        />
                    </div>
                </div>
                <div class="flex mt-4">
                    <div class="required w-full mr-5">
                        <label
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-1
                                bg-transparent
                            "
                        >
                            Address
                        </label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            class="
                                shadow-sm
                                focus:ring-indigo-500 focus:border-indigo-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                                rounded-md
                            "
                            placeholder=""
                            required
                            v-model="address_info.address"
                        />
                    </div>
                    <div class="required w-full ml-5">
                        <label
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-1
                                bg-transparent
                            "
                        >
                            Apartment/Suite
                        </label>
                        <input
                            type="text"
                            id="apartment"
                            name="apartment"
                            class="
                                shadow-sm
                                focus:ring-indigo-500 focus:border-indigo-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                                rounded-md
                            "
                            placeholder=""
                            required
                            v-model="address_info.apartment"
                        />
                    </div>
                </div>
                <div class="required w-full mr-5 mt-5">
                    <label
                        class="
                            block
                            text-gray-600
                            font-semibold
                            mb-1
                            bg-transparent
                        "
                    >
                        Country
                    </label>
                    <select
                        type="select"
                        id="country"
                        name="country"
                        class="
                            shadow-sm
                            focus:ring-indigo-500 focus:border-indigo-500
                            block
                            w-full
                            sm:text-sm
                            border-gray-300
                            rounded-md
                        "
                        placeholder=""
                        required
                        v-model="address_info.country_id"
                    >
                        <option
                            v-for="(country, index) in this.countries"
                            :key="index"
                            :value="country.id"
                        >
                            {{ country.name }}
                        </option>
                    </select>
                </div>
                <div class="flex mt-4">
                    <div class="required w-full">
                        <label
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-1
                                bg-transparent
                            "
                        >
                            City
                        </label>
                        <input
                            type="text"
                            class="
                                shadow-sm
                                focus:ring-indigo-500 focus:border-indigo-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                                rounded-md
                            "
                            placeholder=""
                            required
                            v-model="address_info.city"
                        />
                    </div>
                    <div class="required w-full ml-5">
                        <label
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-1
                                bg-transparent
                            "
                        >
                            State
                        </label>
                        <select
                            type="select"
                            id="state"
                            name="state"
                            class="
                                shadow-sm
                                focus:ring-indigo-500 focus:border-indigo-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                                rounded-md
                            "
                            placeholder=""
                            required
                            v-model="address_info.state_id"
                        >
                            <option value="">Choose a State</option>
                            <option
                                v-for="(state, index) in country_state"
                                :key="index"
                                :value="state.id"
                            >
                                {{ state.name }}
                            </option>
                        </select>
                    </div>
                    <div class="required w-full ml-5">
                        <label
                            class="
                                block
                                text-gray-600
                                font-semibold
                                mb-1
                                bg-transparent
                            "
                        >
                            Zip/Postal Code
                        </label>
                        <input
                            type="text"
                            class="
                                shadow-sm
                                focus:ring-indigo-500 focus:border-indigo-500
                                block
                                w-full
                                sm:text-sm
                                border-gray-300
                                rounded-md
                            "
                            placeholder=""
                            required
                            v-model="address_info.zip"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between w-1/2 mx-auto mb-9">
            <div class="">
                <inertia-link href="/customers">
                    <button
                        class="
                            text-gray-400
                            bg-gray-100
                            border border-gray-400
                            rounded-md
                            px-6
                            py-3
                        "
                    >
                        Cancel
                    </button>
                </inertia-link>
            </div>
            <div class="">
                <button
                    class="text-white bg-indigo-700 rounded-md px-8 py-3"
                    @click="submit"
                >
                    Save
                </button>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { ref, reactive } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import axios from "axios";
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { ChevronRightIcon, ArrowLeftIcon } from "@heroicons/vue/solid";
import { HomeIcon } from "@heroicons/vue/outline";
import { Inertia } from "@inertiajs/inertia";

const pages = [
    { name: "Add Customer", href: "/customers/create", current: false },
];

const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};
export default {
    props: {
        customer: Object,
        countries: Array,
        errors: Object,
        states: Array,
        user: Object,
    },

    components: {
        AppLayout,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        ArrowLeftIcon,
        ChevronRightIcon,
        HomeIcon,
    },

    data() {
        return {
            states: this.states,
            notification: null,
            country_state: {},
            customer: {},
            personal_info: {
                first_name: "",
                last_name: "",
                email: "",
                phone: "",
            },
            address_info: {
                first_name: "",
                last_name: "",
                address: "",
                apartment: "",
                city: "",
                state: "",
            },
            // last_name: this.last_name,
        };
    },
    methods: {
        submit() {
            // this.customer.user = this.personal_info;
            const customer = { ...this.personal_info, ...this.address_info };
            Inertia.post("/customers", customer);
        },
    },
    mounted() {
        this.country_state = this.states;
    },
    watch: {
        "address_info.country_id"(newVal, oldVal) {
            //console.log(oldVal)
            axios.get(`/api/states?country_id=${newVal}`).then((res) => {
                this.country_state = res.data.data;
                console.log(this.country_state);
            });
        },
    },

    setup(props) {
        const open = ref(false);

        // const customer = props.customer;

        // pages.push({
        //     name: customer?.id,
        //     href: `/customers/${customer?.id}`,
        //     current: false,
        // });

        // function submit() {
        //     Inertia.post(`/customers`);
        // }

        return {
            pages,
            statusStyles,
            // submit,
            // list,
        };
    },
};
</script>
