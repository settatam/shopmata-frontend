<template>
    <app-layout>
        <!-- Breadcrumb -->
        <nav class="flex px-8 mt-8" aria-label="Breadcrumb">
            <ol role="list" class="flex items-center space-x-4">
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
                        <ChevronRightIcon
                            class="flex-shrink-0 h-5 w-5 text-gray-400"
                            aria-hidden="true"
                        />
                    </div>
                </li>
                <li>
                    <div>
                        <a
                            href="/dashboard"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            Customer Details
                        </a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex justify-between items-center mx-8 mt-8">
            <div class="flex items-center">
                <h1 class="text-2xl font-semibold text-gray-800">
                    Customer Details
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
                            v-model="customer.first_name"
                            required
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
                            v-model="customer.last_name"
                            required
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
                        v-model="customer.email"
                        required
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
                        v-model="customer.phone_number"
                        required
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
                            v-model="customer.first_name"
                            required
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
                            v-model="customer.last_name"
                            required
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
                            v-model="customer.address"
                            required
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
                            v-model="customer.apartment"
                            required
                        />
                    </div>
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
                            v-model="customer.city"
                            required
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
                            v-model="customer.state"
                            required
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
                            v-model="customer.zip_postal_code"
                            required
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
                        v-model="customer.country"
                        required
                    />
                </div>
            </div>
        </div>
        <div class="flex justify-between w-1/2 mx-auto mb-9">
            <div class="">
                <button
                    class="
                        text-gray-400
                        bg-gray-100
                        border border-gray-400
                        rounded-md
                        px-6
                        py-3
                    "
                    @click="submit"
                >
                    Cancel
                </button>
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

import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { ChevronRightIcon, ArrowLeftIcon } from "@heroicons/vue/solid";
import { HomeIcon } from "@heroicons/vue/outline";
import { Inertia } from "@inertiajs/inertia";

const pages = [{ name: "Orders", href: "/orders", current: false }];

const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};
export default {
    props: {
        customer: Object,
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

    setup(props) {
        const open = ref(false);
        const list = {
            name: "",
            link: "",
        };

        const customer = props.customer;

        pages.push({
            name: customer.id,
            href: `/customers/${customer.id}`,
            current: false,
        });

        function submit() {
            Inertia.post(`/orders`);
        }

        return {
            pages,
            statusStyles,
            submit,
            list,
        };
    },
};
</script>
