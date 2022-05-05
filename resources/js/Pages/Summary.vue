<template>
    <app-layout :navigation="navigation">
        <!-- Page header -->
        <div class="m-3" v-for="(item, index) in summary" :key="item.index">
            <div class="mx-6 mt-8">
                <h1 class="my-3 font-bold text-xl">{{ index }}</h1>
            </div>

            <div class="m-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kits start -->
                <div class=" rounded-md bg-white lg:mx-2 max-h-screen">
                    <!-- header -->
                    <div
                        class="rounded-t-md w-full bg-purple-darken p-4 text-white"
                    >
                        <h1 class="text-xl">Kits</h1>
                    </div>

                    <!-- list -->
                    <div class="p-3">
                        <p
                            v-for="counter in item.kit"
                            :key="counter.index"
                            class="py-1 my-1 px-3 flex justify-between bg-gray-grayer"
                        >
                            <span>{{ counter.counter }}</span>
                            <span>{{ counter.val }}</span>
                        </p>
                    </div>
                </div>
                <!-- Kits end -->

                <div class="space-y-5">
                    <!-- Fedex start -->
                    <div class=" rounded-md bg-white lg:mx-2">
                        <!-- header -->
                        <div
                            class="rounded-t-md w-full bg-purple-darken p-4 text-white"
                        >
                            <h1 class="text-xl">Fedex</h1>
                        </div>

                        <!-- list -->
                        <div class="p-3">
                            <p
                                v-for="counter in item.fedex"
                                :key="counter.index"
                                class="py-1 px-3 flex justify-between my-1 bg-gray-grayer"
                            >
                                <span>{{ counter.counter }}</span>
                                <span>{{ counter.val }}</span>
                            </p>
                        </div>
                    </div>
                    <!-- Fedex end -->

                    <!-- Import start -->
                    <div class=" rounded-md bg-white lg:mx-2">
                        <!-- header -->
                        <div
                            class="rounded-t-md w-full bg-purple-darken p-4 text-white"
                        >
                            <h1 class="text-xl">Import</h1>
                        </div>

                        <!-- list -->
                        <div class="p-3">
                            <p
                                v-for="counter in item.import"
                                :key="counter.index"
                                class="py-1 px-3 flex justify-between my-1 bg-gray-grayer"
                            >
                                <span>{{ counter.counter }}</span>
                                <span>{{ counter.val }}</span>
                            </p>
                        </div>
                    </div>
                    <!-- Import end -->

                    <!-- MISC start -->
                    <div class=" rounded-md bg-white lg:mx-2">
                        <!-- header -->
                        <div
                            class="rounded-t-md w-full bg-purple-darken p-4 text-white"
                        >
                            <h1 class="text-xl">MISC</h1>
                        </div>

                        <!-- list -->
                        <div class="p-3">
                            <p
                                v-for="counter in item.misc"
                                :key="counter.index"
                                class="py-1 px-3 flex justify-between my-1 bg-gray-grayer"
                            >
                                <span>{{ counter.counter }}</span>
                                <span>{{ counter.val }}</span>
                            </p>
                        </div>
                    </div>
                    <!-- MISC end -->
                </div>
            </div>

            <div></div>
        </div>
    </app-layout>
</template>

<script>
import { ref } from 'vue'
import AppLayout from '../Layouts/AppLayout.vue'
import axios from 'axios'
import { BadgeCheckIcon, SearchIcon } from '@heroicons/vue/solid'
import { ScaleIcon } from '@heroicons/vue/outline'

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}

export default {
    components: {
        AppLayout,
        BadgeCheckIcon,
        SearchIcon
    },
    props: {
        notifications: Array,
        navigation: Array,
        summary: Object
    },
    data () {},
    setup (props) {
        const notifications = props.notifications
        const summary = props.summary

        return {
            statusStyles,
            summary
        }
    }
}
</script>
