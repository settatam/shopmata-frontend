<template>
    <app-layout :navigation="navigation">
        <!-- Page header -->
        <div id="container" class="flex flex-col mx-3 space-y-3">
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
                <div class="flex-shrink-0 mb-3 px:3 md:px-6 flex items-center">
                    <p class="text-2xl mt-8 font-bold text-indigo-700">
                        Messages
                    </p>
                </div>

                <!-- <nav class="flex px-3 md:px-6" aria-label="Breadcrumb">
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
                                    <span class="sr-only">Messages</span>
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
                </nav> -->

                <div class="w-auto lg:ml-7 lg:mr-2">
                    <div class="mt-8 py-3">
                        <h1 class="text-xl font-semibold">
                            Send a New Message
                        </h1>
                    </div>
                    <!-- <div class="flex justify-between items-center mb-2 lg:mb-0">
                        <div class="flex font-semibold items-center">
                            <inertia-link href="/admin/settings/notifications">
                                <arrow-left-icon class="w-5 h-5 mr-5" />
                            </inertia-link>
                            <p class="text-base lg:text-2xl"></p>
                        </div>
                        <div class="flex items-center mb-0 lg:mb-5">
                            <div
                                class="text-indigo-700 mr-7 hidden lg:flex"
                            ></div>
                        </div>
                    </div> -->
                    <div class="px-4 md:px-8 pb-8 pt-6 mb-6 bg-white ">
                        <h1 class="text-xl font-bold">Email</h1>

                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Create Message
                            </label>
                            <select
                                v-model.trim="msg.channel"
                                name=""
                                id=""
                                class="mt-1 w-full block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                            >
                                <option default value="null">Select</option>
                                <option
                                    v-for="item in messages"
                                    :key="item.index"
                                    :value="item.channel"
                                    >

                                    <template v-if="item.channel == 'sms'">
                                    {{ item.message }}
                                    </template>

                                    <template v-else>
                                    {{ item.email_subject }}
                                    </template>
                                    
                                    </option>
                            </select>
                        </div>

                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Email subject
                            </label>
                            <input
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Order Confirmation"
                            />
                        </div>

                        <!-- email body start -->

                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Email body (HTML)
                            </label>
                            <textarea
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm h-96"
                                required
                            ></textarea>
                        </div>

                        <!-- email body end -->

                        <!-- SMS SUBJECT START  -->

                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                SMS subject
                            </label>
                            <input
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Order Confirmation"
                            />
                        </div>
                        <!-- sms subject end -->

                        <!-- message start -->

                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Message
                            </label>
                            <textarea
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm h-48"
                                required
                            ></textarea>
                        </div>

                        <!-- message end -->
                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Schedule a Message
                            </label>
                            <select
                                :placeholder="msg.subject"
                                v-model.trim="msg.subject"
                                name=""
                                id=""
                                class="mt-1 w-full block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                            >
                                <option default value="null"
                                    >Immediately</option
                                >
                            </select>
                        </div>
                        <!-- conditions start -->

                        <div class="w-auto relative mt-18">
                            <div>
                                <h1
                                    class="block mt-4 mb-2 bg-transparent font-semibold text-xl"
                                >
                                    Conditions:
                                </h1>
                                <div
                                    class="flex justify-between md:flex-row lg:justify-between space-x-2 mt-4"
                                >
                                    <div class="w-4.5/10 lg:w-3/10">
                                        <p>Products must match:</p>
                                    </div>
                                    <div class="w-4.5/10 lg:w-3/10">
                                        <p>all conditions:</p>
                                    </div>
                                    <div class="w-4.5/10 lg:w-3/10 mb-2">
                                        <p>any condition:</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            v-for="i in 3"
                            :key="i.index"
                            class="w-auto relative"
                        >
                            <div>
                                <div
                                    class="flex justify-between md:flex-row lg:justify-between space-x-2 mt-4"
                                >
                                    <div class="w-4.5/10 lg:w-3/10">
                                        <select
                                            name="options"
                                            id=""
                                            class="rounded-md bmsg bmsg-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium w-full text-gray-700 hover:bg-gray-50 focus:outline-none mb-2 lg:mb-0"
                                        >
                                            <option value="">
                                                Product Title
                                            </option>
                                        </select>
                                    </div>
                                    <div class="w-4.5/10 lg:w-3/10">
                                        <select
                                            name="conditions"
                                            id=""
                                            class="rounded-md bmsg bmsg-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium w-full text-gray-700 hover:bg-gray-50 focus:outline-none"
                                        >
                                            <option value="">
                                                is equal to
                                            </option>
                                        </select>
                                    </div>
                                    <div class="w-4.5/10 lg:w-3/10 mb-2">
                                        <input
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            placeholder="Order Confirmation"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- conditions end -->

                        <div class="w-auto lg:ml-7 lg:mr-2 mt-12">
                            <div class="flex justify-end">
                                <button
                                    type="button"
                                    class="rounded-md bmsg bg-indigo-600 bmsg-transparent shadow-sm px-4 lg:px-7 py-3 text-xs lg:text-base font-medium text-white focus:outline-none sm:text-sm disabled:bg-gray-400"
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
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import { ref, reactive } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import ErrorIcon from '../../../assets/ErrorIcon.vue'
import { HomeIcon } from '@heroicons/vue/outline'
// import SearchRow from './Components/SearchRow.vue'import {
import {
    ChevronLeftIcon,
    ChevronUpIcon,
    ChevronDownIcon,
    ChevronRightIcon,
    ArrowLeftIcon,
    EyeIcon
} from '@heroicons/vue/solid'

const pages = [
    { name: 'Settings', href: '/admin/settings', current: false },
    { name: 'Notifications', href: '/settings/notifications', current: false }
]

export default {
    components: {
        AppLayout,
        ErrorIcon,
        ChevronRightIcon,
        HomeIcon,
        ArrowLeftIcon,
        EyeIcon
    },
    props: ['navigation', 'messages'],

    setup (props) {
        const msg = reactive({
            channel: 'null',
            subject: '',
            sms_message: null,
            email_message: null,
            store_notification_id: null
        })

        const bodyError = ref(false)
        const subjectError = ref(false)
        const loading = ref(false)
        const save = ref('Save')
        const successMessage = ref('')
        const submit = () => {
            loading.value = true
        }

        return {
            bodyError,
            subjectError,
            submit,
            loading,
            save,
            successMessage,
            msg,
            pages
        }
    }
}
</script>
