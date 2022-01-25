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

        <div class="flex justify-between items-center mx-8 mt-8">
            <div class="flex items-center">
                <h1 class="text-2xl font-semibold text-gray-800">
                    Add Customer
                </h1>
            </div>
        </div>

        <!-- Main content -->
        <div class="w-2/3 min-h-screen bg-white mt-7 mb-7 mx-auto rounded-sm">
            <div class="p-8">
                <h2 class="text-xl font-semibold">Personal Information</h2>

                <div class="flex">
                    <div class="required w-full mr-5 mt-4 relative">
                        <label
                            class="block text-gray-600 font-semibold mb-1 bg-transparent"
                        >
                            First Name
                        </label>
                        <input
                            type="text"
                            id="firstName"
                            name="firstName"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder=""
                            required
                            v-model="personal_info.first_name"
                        />
                        <error-icon
                            class="absolute top-10 right-2.5"
                            v-show="firstNameError"
                        />
                    </div>

                    <div class="required w-full mt-4 relative">
                        <label
                            class="block text-gray-600 font-semibold mb-1 bg-transparent"
                        >
                            Last Name
                        </label>
                        <input
                            type="text"
                            id="lastName"
                            name="lastName"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder=""
                            required
                            v-model="personal_info.last_name"
                        />
                        <error-icon
                            class="absolute top-10 right-2.5"
                            v-show="lastNameError"
                        />
                    </div>
                </div>

                <div class="required w-full mr-5 mt-5 relative">
                    <label
                        class="block text-gray-600 font-semibold mb-1 bg-transparent"
                    >
                        Email Address
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder=""
                        required
                        v-model="personal_info.email"
                    />
                    <error-icon
                        class="absolute top-10 right-2.5"
                        v-show="emailError"
                    />
                </div>
                <div class="required w-full mr-5 mt-5 relative">
                    <label
                        class="block text-gray-600 font-semibold mb-1 bg-transparent"
                    >
                        Phone Number
                    </label>
                    <input
                        type="tel"
                        id="tel"
                        name="tel"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder=""
                        required
                        v-model="personal_info.phone_number"
                    />
                    <error-icon
                        class="absolute top-10 right-2.5"
                        v-show="phoneError"
                    />
                </div>
                <div class="border-t-2 border-gray-300 mt-6 mb-7 -mx-8"></div>
                <h2 class="text-xl font-semibold">Address</h2>

                <!-- <div class="required w-full mr-5 mt-4">
                    <label
                        class="block text-gray-600 font-semibold mb-1 bg-transparent"
                    >
                        Full Name
                    </label>
                    <input
                        type="text"
                        id="fullName"
                        name="fullName"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder=""
                        required
                        v-model="address_info.full_name"
                    />
                </div> -->

                <div class="flex mt-4">
                    <div class="required w-full mr-5 relative">
                        <label
                            class="block text-gray-600 font-semibold mb-1 bg-transparent"
                        >
                            Address
                        </label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder=""
                            required
                            v-model="address_info.address"
                        />
                    </div>
                    <div class="required w-full ml-5 relative">
                        <label
                            class="block text-gray-600 font-semibold mb-1 bg-transparent"
                        >
                            Apartment/Suite
                        </label>
                        <input
                            type="text"
                            id="apartment"
                            name="apartment"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder=""
                            required
                            v-model="address_info.apartment"
                        />
                    </div>
                </div>
                <div class="required w-full mr-5 mt-5 relative">
                    <label
                        class="block text-gray-600 font-semibold mb-1 bg-transparent"
                    >
                        Country
                    </label>
                    <select
                        id="country"
                        name="country"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder=""
                        required
                        v-model="address_info.country_id"
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
                <div class="flex mt-4">
                    <div class="required w-full">
                        <label
                            class="block text-gray-600 font-semibold mb-1 bg-transparent"
                        >
                            State
                        </label>
                        <select
                            id="state"
                            name="state"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
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

                    <div class="required w-full ml-5 relative">
                        <label
                            class="block text-gray-600 font-semibold mb-1 bg-transparent"
                        >
                            City
                        </label>
                        <input
                            type="text"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder=""
                            required
                            v-model="address_info.city"
                        />
                        
                    </div>

                    <div class="required w-full ml-5">
                        <label
                            class="block text-gray-600 font-semibold mb-1 bg-transparent"
                        >
                            Zip/Postal Code
                        </label>
                        <input
                            type="text"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder=""
                            required
                            v-model="address_info.zip"
                        />
                    </div>
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
                    type="button"
                    class="disabled:bg-gray-400  bg-indigo-600 text-white rounded-md px-8 py-3"
                    :disabled="loading"
                    @click="submit"
                >
                    <i
                        class="fas fa-spinner fa-pulse text-white m-2"
                        v-if="loading"
                    ></i>
                     {{ save }}
                    <!-- Save -->
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
import { ref, reactive,watch } from "vue";
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
import ErrorIcon from "../../../assets/ErrorIcon.vue";

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
        notification: Object,
        customer_notification: Object,
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
        ErrorIcon,
    },

    setup({ props, customer_notification, notification }) {
        const open = ref(false);
        const country_state = ref({});
        const personal_info = reactive({
            first_name: "",
            last_name: "",
            email: "",
            phone_number: "",
        });
        const address_info = reactive({
            address: "",
            apartment: "",
            country_id: "",
            state_id: "",
            city: "",
            zip: "",
        });
        const firstNameError = ref(false);
        const lastNameError = ref(false);
        const emailError = ref(false);
        const phoneError = ref(false);
        const loading = ref(false);
        const save = ref('Save');
        const successMessage = ref("");

        // onBeforeMount(() => {
        //     customer_notification == null
        //         ? (personal_info.first_name = notification.name)
        //         : (personal_info.first_name = customer_notification.first_name);
        // });
        watch(address_info, (newVal) => {
            axios.get(`/api/states?country_id=${newVal.country_id}`).then((res) => {
                    country_state.value = res.data.data
                });
        });
        function onClickTop() {
            notify(
                {
                    group: "top",
                    title: "Success",
                    text: successMessage.value,
                },
                4000
            );
        }
        function onClickBot() {
            notify(
                {
                    group: "bottom",
                    title: "Error",
                    text: successMessage.value,
                },
                4000
            );
        }
        const loadingFn = () => {
            loading.value = false;
            save.value = "Saving";
            //window.location.href = "/settings/notifications/";
        };
        const errorFn = () => {
            loading.value = false;
            save.value = "Save";
        };
        const error_f_name=()=>{
                        console.log("Hi");
            loading.value = false;
            firstNameError.value = true;
            save.value = "Save";
        }
        const error_email=()=>{
                        console.log("Hi");
            loading.value = false;
            emailError.value = true;
            save.value = "Save";
        }
        const error_l_name=()=>{
                        console.log("Hi");
            loading.value = false;
            lastNameError.value = true;
            save.value = "Save";
        }
        const error_phone=()=>{
                        console.log("Hi");
            loading.value = false;
            phoneError.value = true;
            save.value = "Save";
        }
        const submit = () => {
            loading.value = true;
            // Check which has error and make the error ref true
            if (personal_info.first_name.length<1) {
                save.value = "Saving";
                setTimeout(error_f_name,3000);
            }
            if (personal_info.last_name.length<1) {
                save.value = "Saving";
                setTimeout(error_l_name,3000);
            }
            if (personal_info.email.length<1) {
                save.value = "Saving";
                setTimeout(error_email,3000)
            }
            if (personal_info.phone_number.length<1) {
                save.value = "Saving";
                setTimeout(error_phone,3000)
            }
            // If anyone has an error don't submit
            else {
                const customer = { ...personal_info, ...address_info };
                axios.post("store", customer).then((res) => {
                    console.log(res);
                    if (res.status == 200) {
                        successMessage.value = res.data.message;
                        onClickTop();
                        save.value = "Saving";
                        setTimeout(loadingFn, 3000);
                    } else if (res.status == 422) {
                        successMessage.value = res.data.message;
                        onClickBot();
                        save.value = "Saving";
                        setTimeout(errorFn, 3000);
                    } else {
                        successMessage.value = "Database Error";
                        onClickBot();
                        save.value = "Saving";
                        setTimeout(errorFn, 3000);
                    }
                });
            }
            
        };

       
        return {
            pages,
            statusStyles,
            customer_notification,
            personal_info,
            address_info,
            firstNameError,
            lastNameError,
            emailError,
            phoneError,
            submit,
            save,
            loading,
            country_state,
            submit
            // list,
        };
    },
};
</script>
 