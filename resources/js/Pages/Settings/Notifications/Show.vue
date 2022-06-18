<template>
    <!-- FONT AWESOME LINK -->
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous"
    />
    <!-- FONT AWESOME LINK -->
    <app-layout :navigation="navigation">
        <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
            <!-- Breadcrumb -->
            <div class="flex-shrink-0 mb-3 px:3 md:px-6 flex items-center">
                <p class="text-2xl font-semibold text-gray-900">Settings</p>
            </div>
            <nav class="flex px-3 md:px-6" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a
                                href="/admin/dashboard"
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
                class="flex-1 flex flex-col px-3 md:px-6 lg:px-0 lg:flex-row xl:overflow-hidden mt-5"
            >
                <!-- Secondary sidebar -->
                <Nav page="Notifications"></Nav>
                <!-- Main content -->
                <div class="flex-1 max-h-screen xl:overflow-y-auto">
                    <div class="w-auto lg:ml-7 lg:mr-2">
                        <div
                            class="flex justify-between items-center mb-2 lg:mb-0"
                        >
                            <div class="flex font-semibold items-center">
                                <inertia-link
                                    href="/admin/settings/notifications"
                                >
                                    <arrow-left-icon class="w-5 h-5 mr-5" />
                                </inertia-link>
                                <p class="text-base lg:text-2xl">
                                    {{ notification.name }}
                                </p>
                            </div>
                            <div class="flex items-center mb-0 lg:mb-5">
                                <a :href="previewLink"
                                    class="text-indigo-700 mr-7 hidden lg:flex"
                                >
                                    <EyeIcon
                                        class="w-5 h-5 font-semibold mr-2.5"
                                    />
                                    <p>
                                        <a
                                            :href="'/admin/settings/notifications/'+notification.id+'/preview'"
                                            target="_blank"
                                        > Preview
                                        </a>
                                    </p>
                                </a>
                                <button
                                    type="button"
                                    class="disabled:bg-gray-400 rounded-md border border-transparent shadow-sm px-4 lg:px-7 py-3 text-xs lg:text-base font-medium text-white sm:text-sm"
                                    :disabled="loading"
                                    @click="submit"
                                >
                                    <i
                                        class="fas fa-spinner fa-pulse text-white m-2"
                                        v-if="loading"
                                    ></i
                                    >{{ save }}
                                </button>
                            </div>
                        </div>
                        <div class="px-4 md:px-8 pb-8 pt-6 mb-6 bg-white">
                            <h1 class="text-xl font-bold">Email</h1>
                            <div class="w-auto relative">
                                <label class="block mt-4 mb-2 bg-transparent">
                                    Email subject
                                </label>
                                <input
                                    type="text"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    :placeholder="order.subject"
                                    v-model.trim="order.subject"
                                    required
                                />
                                <error-icon
                                    class="absolute top-11 right-2.5"
                                    v-show="subjectError"
                                />
                            </div>
                            <div class="w-auto relative">
                                <label class="block mt-4 mb-2 bg-transparent">
                                    Email body (HTML)
                                </label>
                                <textarea
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 h-96 rounded-md"
                                    v-model.trim="order.email_message"
                                    required
                                ></textarea>
                                <error-icon
                                    class="absolute top-1 left-40"
                                    v-show="bodyError"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 max-h-screen xl:overflow-y-auto">
                        <div class="w-auto lg:ml-7 lg:mr-2">
                            <div class="px-4 md:px-8 pb-8 pt-6 mb-6 bg-white">
                                <!-- message textarea -->
                                <div class="w-auto relative">
                                    <label
                                        class="block mt-4 mb-2 bg-transparent"
                                    >
                                        Message
                                    </label>
                                    <textarea
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 h-32 rounded-md"
                                        v-model.trim="order.sms_message"
                                        required
                                    ></textarea>
                                    <error-icon
                                        class="absolute top-1 left-40"
                                        v-show="bodyError"
                                    />
                                </div>
                                <!-- message textare ends -->

                                <!-- schedule start -->
                                <div class="w-auto relative">
                                    <div>
                                        <label
                                            class="block mt-4 mb-2 bg-transparent"
                                        >
                                            Schedule a Message
                                        </label>
                                        <select
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            placeholder=""
                                            required
                                        >
                                            <option value="">
                                                Immediately
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!-- schedule end -->

                                <!-- conditions start -->
                                <div class="w-auto relative">
                                    <div>
                                        <label
                                            class="block mt-4 mb-2 bg-transparent"
                                        >
                                            Schedule a Message
                                        </label>
                                        <div
                                            class="flex justify-between md:flex-row lg:justify-between space-x-2 mt-4"
                                        >
                                            <div class="w-4.5/10 lg:w-3/10">
                                                <select
                                                    name="model"
                                                    id=""
                                                    class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium w-full text-gray-700 hover:bg-gray-50 focus:outline-none mb-2 lg:mb-0"
                                                    v-model="order.model"

                                                >
                                                    <option value="Transaction">
                                                        Transaction
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="w-4.5/10 lg:w-3/10">
                                                <select
                                                    name="conditions"
                                                    id=""
                                                    class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium w-full text-gray-700 hover:bg-gray-50 focus:outline-none"
                                                    v-model="order.condition"

                                                >   
                                                    <option  value="==">==</option>
                                                    
                                                </select>
                                            </div>
                                            <div
                                                class="w-4.5/10 lg:w-3/10 mb-2"
                                            >
                                                <select
                                                    name="status_id"
                                                    id=""
                                                    class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 w-full hover:bg-gray-50 focus:outline-none"
                                                    v-model="order.status_id"
                                                >
                                                    <option  value="">Choose Status</option>
                                                    <option v-for="status in statuses" :key="status.index" :value="status.status_id">
                                                        {{ status.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- conditions end -->
                            </div>
                        </div>
                    </div>

                    <div class="w-auto lg:ml-7 lg:mr-2">
                        <div class="flex justify-between">
                            <button
                                type="button"
                                class="rounded-md border border-gray-500 mr-4 shadow-sm px-3 lg:px-5 py-1.5 lg:py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none sm:text-sm"
                            >
                                Back to default
                            </button>
                            <button
                                type="button"
                                class="rounded-md border bg-indigo-600 border-transparent shadow-sm px-4 lg:px-7 py-3 text-xs lg:text-base font-medium text-white focus:outline-none sm:text-sm disabled:bg-gray-400"
                                :disabled="loading"
                                @click="submit"
                            >
                                <i
                                    class="fas fa-spinner fa-pulse text-white m-1"
                                    v-if="loading"
                                ></i
                                >{{ save }}
                            </button>
                        </div>
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
import AppLayout from "../../../Layouts/AppLayout.vue";
import SmsBox from "./Components/SmsBox.vue";
import Nav from "../Nav";
import {
    ChevronLeftIcon,
    ChevronUpIcon,
    ChevronDownIcon,
    ChevronRightIcon,
    ArrowLeftIcon,
    EyeIcon,
} from "@heroicons/vue/solid";
import { reactive, ref } from "@vue/reactivity";
import ErrorIcon from "../../../../assets/ErrorIcon.vue";
import { HomeIcon } from "@heroicons/vue/outline";
import axios from "axios";
import notify from "../../../Utils/notification";

const pages = [
    { name: "Settings", href: "/admin/settings", current: false },
    { name: "Notifications", href: "/settings/notifications", current: false },
];

export default {
    props: {
        store_notification: Object,
        notification: Object,
        navigation: Array,
        sms: Object,
        email: Object,
        statuses: Array
    },
    components: {
        AppLayout,
        ChevronRightIcon,
        HomeIcon,
        Nav,
        ArrowLeftIcon,
        EyeIcon,
        ErrorIcon,
    },
    setup({ email, sms, notification }) {
        const order = reactive({
            subject: email ? email.email_subject : null,
            sms_message: sms ? sms.message : null,
            email_message: email ? email.message : null,
            store_notification_id: notification.id,
            status_id: "",
            condition: "==",
            model: "Transaction",
            channels: ["sms", "email"],
        });

        const { onClickTop, onClickBot } = notify();

        const bodyError = ref(false);
        const subjectError = ref(false);
        const loading = ref(false);
        const save = ref("Save");
        const successMessage = ref("");
        const previewLink = ref("/settings/notifications/" + notification.id + "/preview");

        const submit = () => {
            loading.value = true;
            axios
                .post("store", order)
                .then((res) => {
                    loading.value = false;
                    setTimeout(onClickTop("Notification added"), 2000);
                })
                .catch((error) => {
                    loading.value = false;
                    setTimeout(onClickBot("Something went wrong"), 2000);
                });
        };

        return {
            pages,
            order,
            bodyError,
            subjectError,
            submit,
            loading,
            save,
            successMessage,
            onClickTop,
            onClickBot,
            previewLink
        };
    },
};
</script>

<style></style>
