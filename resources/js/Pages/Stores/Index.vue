<template>
    <app-layout :navigation="navigation">
        <div class="mx-3 flex flex-col my-4">



            <div class="grid place-items-center">

                <div class="flex flex-row justify-start w-full md:w-4/6">
                    <div class=" py-8">
                        <h1 class="text-xl">Stores</h1>
                    </div>
                </div>

                <div class="flex flex-row justify-between mx-3 my-3 border-2 px-4 py-3 border-gray-300 rounded-md w-full md:w-4/6"
                    v-for="store in stores" :key="store.index">
                    <div class="flex flex-row">
                        <HomeIcon class="h-10 mt-1 text-gray-500 w-14 font-thin" />
                        <div class="flex ml-8 flex-col ">
                            <p class="text-gray-500 text-lg font-semibold">{{ store.name }}</p>
                            <a class="text-purple-darken text-xs font-semibold" :href="store.store_domain">{{
                                    store.store_domain
                            }}</a>
                        </div>
                    </div>

                    <inertia-link class="flex-col flex justify-center cursor-pointer" :href="'/admin/dashboard/store_id='+ store.id">
                        <ArrowNarrowRightIcon class=" text-gray-500 w-8" />
                    </inertia-link>
                </div>


                <div class="mt-4"><a class="text-purple-darken font-bold" href="/admin/stores/create">Create New Store</a></div>
            </div>


        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
import { HomeIcon, ArrowNarrowRightIcon } from '@heroicons/vue/outline'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        AppLayout,
        HomeIcon,
        ArrowNarrowRightIcon
    },
    props: ['navigation', 'store', 'stores'],
    setup() {
        return {}
    }
}
</script>