<template>
    <app-layout :navigation="navigation">
        <!-- Page header -->
        <div id="container" class="flex flex-col mx-3 space-y-1">
            <div class="mx-2">
                <SearchRow />
            </div>

            <TransactionTable />

            <div class="">
                <TopRow class="mt-8" />
            </div>

            <div>
                <FilterBy />
            </div>

            <shopmata-table :filters="filters"></shopmata-table>

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
                                        <div class="flex flex-shrink-0 ml-4">
                                            <button
                                                @click="close(notification.id)"
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
    </app-layout>
</template>
<script>
import { ref, reactive } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import axios from "axios";
import { SearchIcon, PlusIcon } from "@heroicons/vue/solid";
import { Inertia } from "@inertiajs/inertia";
import TopRow from "./Components/TopRow.vue";
import SearchRow from "./Components/SearchRow.vue";
import TransactionTable from "./Components/TransactionTable.vue";
import FilterBy from "./Components/FilterBy.vue";
import Entries from "./Components/Entries.vue";
import ReportLayout from "./Components/ReportLayout.vue";
import ShopmataTable from "../Widgets/ShopmataTable";

export default {
    components: {
        AppLayout,
        SearchIcon,
        SearchRow,
        TransactionTable,
        FilterBy,
        Entries,
        TopRow,
        ReportLayout,
        ShopmataTable,
    },
    props: {
        notifications: Array,
        filters: Object,
        navigation: Array,
        genders: Array,
    },
    setup(props) {
        console.log(props.genders);
    },
};
</script>
