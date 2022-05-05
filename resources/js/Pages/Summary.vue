<template>
    <app-layout :navigation="navigation">
        <!-- Page header -->
        <div v-for="(item, index) in summary" :key="item.index">
            <div>
                <h1 class="my-3 font-bold text-xl">{{ index }}</h1>
            </div>

            <div class="m-3 grid grid-cols-2 gap-4">
                <div>
                    <p>{{ item.fedex }}</p>
                </div>

                <div>
                    <p>{{ item.import }}</p>
                </div>

                <div>
                    <p>{{ item.kit }}</p>
                </div>

                <div>
                    <p>{{ item.misc }}</p>
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
import {
    BadgeCheckIcon,
    ChevronDownIcon,
    ChevronRightIcon,
    CollectionIcon,
    SearchIcon,
    SortAscendingIcon,
    StarIcon,
    ShoppingBagIcon
} from '@heroicons/vue/solid'
import { ScaleIcon } from '@heroicons/vue/outline'

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}

export default {
    components: {
        AppLayout,
        ScaleIcon,
        BadgeCheckIcon,
        ChevronDownIcon,
        ChevronRightIcon,
        CollectionIcon,
        SearchIcon,
        SortAscendingIcon,
        ShoppingBagIcon,
        StarIcon
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
