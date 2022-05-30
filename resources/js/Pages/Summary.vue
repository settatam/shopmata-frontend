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
                        <inertia-link
                            v-for="counter in item.kit"
                            :key="counter.index"
                            :href="'/admin/transactions?'+counter.href"
                            class="py-1 my-1 px-3 flex justify-between bg-gray-grayer"
                        >
                            <span>{{ counter.counter }}</span>
                            <span>{{ counter.val }}</span>
                        </inertia-link>
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
                            <inertia-link
                                v-for="counter in item.fedex"
                                :key="counter.index"
                                :href="'/admin/transactions?'+counter.href"
                                class="py-1 px-3 flex justify-between my-1 bg-gray-grayer"
                            >
                                <span>{{ counter.counter }}</span>
                                <span>{{ counter.val }}</span>
                            </inertia-link>
                        </div>
                    </div>
                    <!-- Fedex end -->

                    <!-- MISC start -->
<!--                    <div class=" rounded-md bg-white lg:mx-2">-->
<!--                        &lt;!&ndash; header &ndash;&gt;-->
<!--                        <div-->
<!--                            class="rounded-t-md w-full bg-purple-darken p-4 text-white"-->
<!--                        >-->
<!--                            <h1 class="text-xl">MISC</h1>-->
<!--                        </div>-->

<!--                        &lt;!&ndash; list &ndash;&gt;-->
<!--                        <div class="p-3">-->
<!--                            <p-->
<!--                                v-for="counter in item.misc"-->
<!--                                :key="counter.index"-->
<!--                                class="py-1 px-3 flex justify-between my-1 bg-gray-grayer"-->
<!--                            >-->
<!--                                <span>{{ counter.counter }}</span>-->
<!--                                <span>{{ counter.val }}</span>-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- MISC end -->
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout.vue'
import {  SearchIcon } from '@heroicons/vue/solid'

const filters = {
    type: 'TransactionsTable',
    // status: 60
}


export default {
    components: {
        AppLayout,
        SearchIcon
    },
    props: {
        navigation: Array,
        summary: Object
    },
    data () {},
    setup (props) {
        const summary = props.summary
        return {
            summary,
            filters
        }
    }
}
</script>
