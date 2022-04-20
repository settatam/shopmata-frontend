<template>
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
                <Nav page="Notifications"></Nav>
                <!-- Main content -->
                <div class="flex-1 max-h-screen xl:overflow-y-auto">
                    <div class="w-auto lg:ml-7 lg:mr-2">
                        <div class="mb-6">
                            <div
                                class="flex flex-row w-full justify-between py-4"
                            >
                                <h1 class="text-2xl font-semibold">
                                    Notifications
                                </h1>

                                <button
                                    class="bg-purple-darken px-2 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken inline-flex items-center"
                                    type="submit"
                                    @click="popModal()"
                                >
                                    <span class="pl-2"
                                        >Create Notification</span
                                    >
                                </button>
                            </div>

                            <CreateNotification
                                @close="popUp = false"
                                v-if="popUp"
                            />

                            <p class="text-gray-500 mb-4">
                                Click on any option to select an editable
                                template that will be used to send messages to
                                your customer.
                            </p>
                            <OrdersBox
                                :notifications="notifications"
                                :openOrder="openOrder"
                            />

                            <LocalDeliveryBox
                                :notifications="notifications"
                                :openLocal="openLocal"
                            />

                            <ShippingBox
                                :notifications="notifications"
                                :openShipping="openShipping"
                            />

                            <LocalPickupBox
                                :notifications="notifications"
                                :openPickup="openPickup"
                            />

                            <CustomerBox
                                :notifications="notifications"
                                :openCustomer="openCustomer"
                            />

                            <EmailMarketingBox
                                :notifications="notifications"
                                :openMarketing="openMarketing"
                            />

                            <error
                                v-if="error"
                                :msg="successMessage"
                                class="w-full z-30"
                            />
                            <success
                                v-if="success"
                                :msg="successMessage"
                                class="w-full z-30"
                            />

                            <!-- 
                            <h1 class="text-2xl font-semibold">
                                Staff order notifications
                            </h1>
                            <p class="text-gray-500 mb-4">
                                Choose how you want to be
                                <span class="text-indigo-700">notified</span>
                                when a new order comes in or add other
                                recipients. You can also subscribe to the
                                <span class="text-indigo-700">RSS</span> feed
                                for this store's orders.
                            </p>
                            <div class="p-4 md:p-8 my-6 bg-white">
                                <div
                                    class="flex items-center justify-between mb-5"
                                >
                                    <h2 class="font-bold text-xl">Templates</h2>
                                    <chevron-up-icon
                                        class="w-6 h-6 text-indigo-700 cursor-pointer"
                                        @click="openTemplate = false"
                                        v-if="openTemplate"
                                    />
                                    <chevron-down-icon
                                        class="w-6 h-6 text-indigo-700 cursor-pointer"
                                        @click="openTemplate = true"
                                        v-else
                                    />
                                </div>
                                <div v-if="openTemplate">
                                    <p class="text-indigo-700">New Order</p>
                                    <p class="text-gray-500">
                                        Sent to order notification subscribers
                                        when a customer places an order.
                                    </p>
                                </div>
                            </div>
                            <div class="p-4 md:p-8 my-6 bg-white">
                                <div
                                    class="flex items-center justify-between mb-5"
                                >
                                    <h2 class="font-bold text-xl">
                                        Recipients
                                    </h2>
                                    <chevron-up-icon
                                        class="w-6 h-6 text-indigo-700 cursor-pointer"
                                        @click="openRecipient = false"
                                        v-if="openRecipient"
                                    />
                                    <chevron-down-icon
                                        class="w-6 h-6 text-indigo-700 cursor-pointer"
                                        @click="openRecipient = true"
                                        v-else
                                    />
                                </div>
                                <div v-if="openRecipient">
                                    <div
                                        class="flex items-center justify-between mb-5 flex-col md:flex-row"
                                    >
                                        <div class="">
                                            <p class="text-indigo-700">
                                                Send test notification
                                            </p>
                                            <p class="text-gray-500">
                                                Send email to "Esther Lagos"
                                                esthercoded@enkoded.com
                                            </p>
                                        </div>
                                        <button
                                            type="button"
                                            class="mt-7 md:mt-0 inline-flex items-center px-7 py-3 font-semibold border border-indigo-500 rounded-md shadow-sm bg-transparent text-indigo-500 hover:bg-indigo-100"
                                        >
                                            Disable
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 md:p-8 my-6 bg-white">
                                <div
                                    class="flex items-center justify-between mb-5"
                                >
                                    <h2 class="font-bold text-xl">
                                        Desktop Notification
                                    </h2>
                                    <chevron-up-icon
                                        class="w-6 h-6 text-indigo-700 cursor-pointer"
                                        @click="openNotification = false"
                                        v-if="openNotification"
                                    />
                                    <chevron-down-icon
                                        class="w-6 h-6 text-indigo-700 cursor-pointer"
                                        @click="openNotification = true"
                                        v-else
                                    />
                                </div>
                                <div v-if="openNotification">
                                    <p class="text-gray-500">
                                        Get desktop notifications when you
                                        receive a new order. This setting only
                                        applies to your current browser — you
                                        must have the Shopify admin open in this
                                        browser to receive desktop
                                        notifications.
                                    </p>
                                    <button
                                        type="button"
                                        class="mt-7 inline-flex items-center px-3 py-2 font-semibold border border-indigo-500 rounded-md shadow-sm bg-transparent text-indigo-500 hover:bg-indigo-100"
                                    >
                                        Enable Desktop Notifications
                                    </button>
                                </div>
                            </div> -->
                        </div>
                    </div>
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
import { reactive, ref } from '@vue/reactivity'
import AppLayout from '../../../Layouts/AppLayout.vue'
import Search from '../../Search.vue'
import Nav from '../Nav'
import axios from 'axios'
import CreateNotification from './Components/CreateNotification.vue'

import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot
} from '@headlessui/vue'
import {
    ChevronLeftIcon,
    ChevronUpIcon,
    ChevronDownIcon,
    ChevronRightIcon
} from '@heroicons/vue/solid'
import { HomeIcon } from '@heroicons/vue/outline'
import { onBeforeMount, watch, watchEffect } from '@vue/runtime-core'
import { notify } from 'notiwind'
import OrdersBox from './Components/OrdersBox.vue'
import LocalDeliveryBox from './Components/LocalDeliveryBox.vue'
import EmailMarketingBox from './Components/EmailMarketingBox.vue'
import CustomerBox from './Components/CustomerBox.vue'
import ReturnsBox from './Components/ReturnsBox.vue'
import ShippingBox from './Components/ShippingBox.vue'
import LocalPickupBox from './Components/LocalPickupBox.vue'

const pages = [
    { name: 'Settings', href: '/settings', current: false },
    { name: 'Notifications', href: '/settings/notifications', current: true }
]

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}
export default {
    props: {
        notifications: Object,
        email_marketing_settings: Array
    },
    emits: ['close'],
    components: {
        Nav,
        AppLayout,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        ChevronUpIcon,
        ChevronDownIcon,
        ChevronRightIcon,
        HomeIcon,
        OrdersBox,
        LocalDeliveryBox,
        ShippingBox,
        LocalPickupBox,
        CustomerBox,
        EmailMarketingBox,
        ReturnsBox,
        CreateNotification
    },

    data () {
        return {
            openOrder: true,
            openLocal: true,
            openShipping: true,
            openPickup: true,
            openCustomer: true,
            openMarketing: true,
            openReturn: true,
            openTracking: true,
            openTemplate: true,
            openRecipient: true,
            openNotification: true,
            emailTracking: {
                0: {
                    title: 'Optimize open tracking (recommended)',
                    description:
                        'Track email open rates and maintain your sender reputation. Choose this option to balance customer privacy choices with data collection.',
                    value: 'optimize_open_tracking'
                },
                1: {
                    title: 'Do not track',
                    description:
                        'Your email open rate will not be reported. You will still be able to see other metrics, such as the number of clicks from subscribers in your emails.',
                    value: 'do_not_track'
                },
                2: {
                    title: 'Ask for consent',
                    description:
                        'By default, email opens will not be tracked. Subscribers will be able to opt-in to tracking through the footer of your emails. Your open rate will be reported based on subscribers who opt-in, combined with overall engagement.',
                    value: 'ask_for_consent'
                },
                3: {
                    title: 'Track all email opens',
                    description:
                        'See how many subscribers open your emails. This will provide the most accurate reporting into open behavior.',
                    value: 'track_all_email_opens'
                }
            }
        }
    },
    setup ({ email_marketing_settings }) {
        const email_marketing = reactive({
            double_opt_in:
                email_marketing_settings.length == 0
                    ? 0
                    : email_marketing_settings[0].double_opt_in,
            open_tracking:
                email_marketing_settings.length == 0
                    ? 'optimize_open_tracking'
                    : email_marketing_settings[0].open_tracking
        })
        const success = ref(false)
        const error = ref(false)
        const successMessage = ref('')
        const popUp = ref(false)

        function onClickTop () {
            notify(
                {
                    group: 'top',
                    title: 'Success',
                    text: successMessage.value
                },
                4000
            )
        }
        function onClickBot () {
            notify(
                {
                    group: 'bottom',
                    title: 'Error',
                    text: successMessage.value
                },
                4000
            )
        }

        const popModal = () => {
            popUp.value = true
            console.log(popUp.value)
        }

        watch(email_marketing, (curr, prev) => {
            axios.post('notifications/email-marketing', curr).then(res => {
                if (res.status == 200) {
                    successMessage.value = res.data.message
                    onClickTop()
                } else if (res.status == 422) {
                    successMessage.value = res.data.message
                    onClickBot()
                } else {
                    successMessage.value = 'Error processing your request'
                    onClickBot()
                }
            })
        })

        return {
            statusStyles,
            pages,
            email_marketing,
            success,
            error,
            successMessage,
            onClickTop,
            onClickBot,
            popModal,
            popUp
        }
    }
}
</script>
