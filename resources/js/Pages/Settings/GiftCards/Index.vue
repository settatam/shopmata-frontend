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
            <div class="flex-shrink-0 mb-3 px-6 xflex items-center">
                <p class="text-2xl font-semibold text-gray-900">Settings</p>
            </div>
            <nav class="flex px-6" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a
                                href="/dashboards"
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
                <Nav page="GiftCards"></Nav>
                <!-- Main content -->
                <div class="flex-1 max-h-screen xl:overflow-y-auto">
                    <div class="w-full xl:w-9.5/10 xl:ml-7">
                        <div class="p-4 md:p-8 bg-white">
                            <h1 class="text-2xl mb-2 font-semibold">
                                Gift Cards
                            </h1>
                            <h2 class="text-lg font-semibold">
                                Auto-expiration
                            </h2>
                            <p class="text-gray-400 text-sm mt-2 mb-5">
                                Set your gift cards to expire a certain amount
                                of time after they,ve been purchased.
                            </p>
                            <error
                                v-if="error"
                                :msg="successMessage"
                                class="sticky top-20 w-full z-30"
                            />
                            <success
                                v-if="success"
                                :msg="successMessage"
                                class="sticky top-20 w-full z-30"
                            />
                            <div
                                class="border border-gray-300 px-3 md:px-7 pt-7 pb-6"
                            >
                                <div class="flex flex-col">
                                    <p
                                        class="ml-4 md:ml-9 mb-2 my-auto cursor-pointer"
                                        @click="gift.expire = 2"
                                    >
                                        <input
                                            type="radio"
                                            name=""
                                            value="2"
                                            v-model="gift.expire"
                                            id=""
                                            class="cursor-pointer custom-form-radio mr-5"
                                        />Gift cards expires
                                    </p>
                                    <p
                                        class="ml-4 md:ml-9 mb-6 my-auto cursor-pointer"
                                        @click="reset_gift"
                                    >
                                        <input
                                            type="radio"
                                            name=""
                                            value="1"
                                            v-model="gift.expire"
                                            id=""
                                            class="cursor-pointer custom-form-radio mr-5"
                                        />Gift cards never expires
                                    </p>
                                </div>
                                <div class="flex mb-6" v-if="gift.expire == 2">
                                    <input
                                        type="text"
                                        name=""
                                        v-model="gift.period"
                                        placeholder="5"
                                        class="w-20 mr-2.5 shadow-sm focus:ring-indigo-500 placeholder-gray-200 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md"
                                    />
                                    <select
                                        name=""
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        v-model="gift.duration"
                                    >
                                        <option value="" disabled>
                                            Select Duration
                                        </option>
                                        <option value="years">
                                            Years after purchase
                                        </option>
                                        <option value="months">
                                            Months after purchase
                                        </option>
                                        <option value="days">
                                            Days after purchase
                                        </option>
                                    </select>
                                </div>
                                <p class="text-gray-400">
                                    Countries have different laws for gift card
                                    expiry dates. Check the laws for your
                                    country before changing this date.
                                </p>
                            </div>
                        </div>
                        <button
                            class="text-white rounded-md px-8 py-3 float-right my-5"
                            :class="loading ? 'bg-gray-400' : 'bg-indigo-600'"
                            @click="submit"
                            :disabled="
                                (gift.expire == 2 && !gift.period) || loading
                            "
                        >
                            <i
                                class="fas fa-spinner fa-pulse text-white m-1"
                                v-if="loading"
                            ></i
                            >{{ save }}
                        </button>
                    </div>
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
                                                <div
                                                    class="ml-3 w-0 flex-1 pt-0.5"
                                                >
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
                                                            close(
                                                                notification.id
                                                            )
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
                                                    >{{
                                                        notification.title
                                                    }}</span
                                                >
                                                <p
                                                    class="text-sm text-gray-600"
                                                >
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
    </app-layout>
</template>

<script>
import { reactive, ref, onMounted } from "vue";
import AppLayout from "../../../Layouts/AppLayout.vue";
import Search from "../../Search.vue";
import Nav from "../Nav";
import axios from "axios";
const pages = [
    { name: "Settings", href: "/settings", current: false },
    { name: "Gift Cards", href: "/settings/gift-cards", current: true },
];
import Success from "../../../Components/Success.vue";
import Error from "../../../Components/Error.vue";
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
import { HomeIcon } from "@heroicons/vue/outline";
import { notify } from "notiwind";
const statusStyles = {
    success: "bg-green-100 text-green-800",
    processing: "bg-yellow-100 text-yellow-800",
    failed: "bg-gray-100 text-gray-800",
};
export default {
    components: {
        Nav,
        AppLayout,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        ChevronRightIcon,
        HomeIcon,
        Success,
        Error,
    },
    props: {
        store: Object,
    },

    setup(props) {
        const store = props.store;
        const open = ref(false);
        const gift = reactive({
            duration: store.gift_card_expiry_duration,
            period: store.gift_card_expire_after,
            expire: store.gift_card_should_expire,
        });
        const loading = ref(false);
        const save = ref("Save");
        const success = ref(false);
        const error = ref(false);
        const successMessage = ref("Sucessfully Saved");

        const reset_gift = () => {
            gift.duration = "";
            gift.period = "";
            gift.expire = 1;
        };
        const loadingFn = () => {
            loading.value = false;
            success.value = false;
            save.value = "Save";
        };
        const errorFn = () => {
            loading.value = false;
            error.value = false;
            save.value = "Save";
        };
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
        const submit = () => {
            axios
                .post("gift-cards", gift)
                .then((res) => {
                    loading.value = true;
                    if (res.status == 200) {
                        successMessage.value = res.data.notification.message;
                        setTimeout(onClickTop, 2000);
                        save.value = "Saving";
                        setTimeout(loadingFn, 3000);
                    } else if (res.status == 400) {
                        successMessage.value = res.data.notification.message;
                        setTimeout(onClickBot, 2000);
                        setTimeout(errorFn, 3000);
                    } else {
                        successMessage.value = "Database Error";
                        setTimeout(onClickBot, 2000);
                        setTimeout(errorFn, 3000);
                    }
                })
                .catch((error) => {
                    successMessage.value =
                        "Sorry, we could not process your request at the moment";
                    setTimeout(onClickBot, 2000);
                    setTimeout(errorFn, 3000);
                });
        };
        return {
            statusStyles,
            pages,
            submit,
            gift,
            open,
            loading,
            save,
            success,
            error,
            successMessage,
            reset_gift,
            onClickTop,
            onClickBot,
            gift,
            store,
        };
    },
};
</script>
