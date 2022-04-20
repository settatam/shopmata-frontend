<template>
    <!-- FONT AWESOME LINK -->
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous"
    />
    <!-- FONT AWESOME LINK -->
    <TransitionRoot as="template" :show="open">
        <Dialog
            as="div"
            class="fixed z-10 inset-0 overflow-y-auto "
            @close="closeModal()"
        >
            <div
                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to="opacity-100 translate-y-0 sm:scale-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100 translate-y-0 sm:scale-100"
                    leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div
                        class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-2 sm:align-middle sm:max-w-xl sm:w-full sm:p-6"
                    >
                        <div>
                            <div class="flex justify-between ">
                                <div>
                                    <p class="text-2xl font-bold">
                                        Add Account Details
                                    </p>
                                    <p class="text-gray-400 text-sm mt-4">
                                        Enter your bank account details to
                                        receive payments via transfer
                                    </p>
                                </div>
                                <x-icon
                                    class="h-6 w-6 cursor-pointer"
                                    @click="closeModal"
                                />
                            </div>
                            <div class="mt-3 sm:mt-5">
                                <div class=" required w-full mb-4 relative">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Bank Name
                                    </label>
                                    <input
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        v-model="payment.bank_name"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="bank_name_error"
                                    />
                                </div>
                                <div class=" required w-full mb-4 relative">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Account Name
                                    </label>
                                    <input
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        v-model="payment.account_name"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="account_name_error"
                                    />
                                </div>
                                <div class=" required w-full mb-4 relative">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Account Number
                                    </label>
                                    <input
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        v-model="payment.account_number"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="account_number_error"
                                    />
                                </div>
                                <div class=" required w-full mb-4 relative">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Routing Number
                                    </label>
                                    <input
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        v-model="payment.routing_number"
                                        required
                                    />
                                    <error-icon
                                        class="absolute top-11 right-2.5"
                                        v-show="routing_error"
                                    />
                                </div>
                                <div class="required w-1/3 mb-4">
                                    <label
                                        class="block text-gray-600 font-semibold mb-2 bg-transparent"
                                    >
                                        Payment Frequency
                                    </label>
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <div class=" items-center">
                                            <input
                                                type="radio"
                                                value="0"
                                                class="mr-3"
                                                v-model="
                                                    payment.payout_schedule
                                                "
                                                name="daily"
                                            />
                                            <label
                                                for="daily"
                                                @click="
                                                    payment.payout_schedule =
                                                        '0'
                                                "
                                                class="cursor-pointer"
                                            >
                                                Daily</label
                                            >
                                        </div>

                                        <div class=" items-center">
                                            <input
                                                type="radio"
                                                class="mr-3"
                                                value="1"
                                                v-model="
                                                    payment.payout_schedule
                                                "
                                                name="weekly"
                                            />
                                            <label
                                                for="weekly"
                                                @click="
                                                    payment.payout_schedule =
                                                        '1'
                                                "
                                                class="cursor-pointer"
                                            >
                                                Weekly</label
                                            >
                                        </div>
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
                                                    <div
                                                        class="ml-3 w-0 flex-1 pt-0.5"
                                                    >
                                                        <p
                                                            class="font-semibold text-gray-800"
                                                        >
                                                            {{
                                                                notification.title
                                                            }}
                                                        </p>
                                                        <p
                                                            class="text-sm font-semibold text-gray-500"
                                                        >
                                                            {{
                                                                notification.text
                                                            }}
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
                                                            <span
                                                                class="sr-only"
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
                        <div class=" flex justify-between">
                            <button
                                type="button"
                                class=" rounded-md border border-gray-500 mr-4 shadow-sm px-10 py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"
                                @click="closeModal"
                            >
                                Cancel
                            </button>
                            <button
                                type="button"
                                class=" rounded-md border border-transparent shadow-sm px-10 py-3 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm disabled:bg-gray-400"
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
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import { ref, reactive, onBeforeMount } from 'vue'
import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot
} from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/solid'
import axios from 'axios'
//import { Inertia } from '@inertiajs/inertia'
import ErrorIcon from '../../../../../assets/ErrorIcon.vue'
import { hrefToUrl } from '@inertiajs/inertia'
import { notify } from 'notiwind'

export default {
    emits: ['close'],
    props: {
        store: Object
    },
    components: {
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        XIcon,
        TransitionRoot,
        ErrorIcon
    },
    setup (props, { emit }) {
        const open = ref(true)
        const payment = reactive({
            account_name: '',
            bank_name: '',
            account_number: '',
            routing_number: '',
            payout_schedule: '1'
        })
        const bank_name_error = ref(false)
        const account_name_error = ref(false)
        const account_number_error = ref(false)
        const routing_error = ref(false)
        const successMessage = ref('')
        const save = ref('Save')
        const loading = ref(false)

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

        const loadingFn = () => {
            loading.value = false
            save.value = 'Save'
            closeModal()
            window.location.href = '/settings/remittance'
        }
        const errorFn = () => {
            loading.value = false
            save.value = 'Save'
        }
        const submit = () => {
            //validation
            save.value = 'Saving'
            loading.value = true
            if (!payment.account_name.length) {
                setTimeout((account_name_error.value = true), 2500)
                setTimeout(errorFn, 3000)
            }
            if (!payment.bank_name.length) {
                setTimeout((bank_name_error.value = true), 2500)
                setTimeout(errorFn, 3000)
            }
            if (!payment.account_number) {
                setTimeout((account_number_error.value = true), 2500)
                setTimeout(errorFn, 3000)
            }
            if (!payment.routing_number.length && store.country_id == 1) {
                setTimeout((routing_error.value = true), 2500)
                setTimeout(errorFn, 3000)
            } else {
                axios.post('', payment).then(res => {
                    loading.value = true
                    if (res.status == 200) {
                        successMessage.value = res.data.message
                        onClickTop()
                        save.value = 'Saving'
                        setTimeout(loadingFn, 3000)
                    } else if (res.status == 422) {
                        successMessage.value = res.data.message
                        onClickBot()
                        setTimeout(errorFn, 3000)
                    } else {
                        successMessage.value = 'Error processing your request'
                        onClickBot()
                        setTimeout(errorFn, 3000)
                    }
                })
            }
        }
        const closeModal = () => {
            open.value = false
            emit('close')
        }

        return {
            open,
            payment,
            closeModal,
            submit,
            loading,
            save,
            successMessage,
            account_name_error,
            account_number_error,
            bank_name_error,
            routing_error,
            onClickTop,
            onClickBot
        }
    }
}
</script>
