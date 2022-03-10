<template>
    <app-layout>
        <div id="container">
            <div
                class="bg-gray-background w-full flex flex-col lg:space-y-8 px-4"
            >
                <!-- container for  containers -->
                <div class="flex flex-col lg:flex-row w-full h-full">
                    <div class="w-full lg:w-1/2">
                        <TransactionBox1 class="my-4 h-full" />
                    </div>
                    <div class="w-full lg:w-1/2">
                        <TransactionBox2 class="my-4 h-full" />
                    </div>
                </div>

                <!-- row 2 -->
                <div class=" w-full flex flex-col lg:flex-row h-full">
                    <div class="w-full lg:w-1/3">
                        <TransactionBox3 class="my-4 h-full" />
                    </div>

                    <div class="w-full lg:w-1/3">
                        <TransactionBox4 class="my-4 h-full" />
                    </div>

                    <div class="w-full lg:w-1/3">
                        <TransactionBox5 class="my-4 h-full" />
                    </div>
                </div>

                <!-- row 3 -->
                <div class="w-full">
                    <ItemTable class="my-4" />
                </div>
                <!-- row 3 ends -->

                <!-- row 4 -->
                <div class="w-full">
                    <!-- <TransactionTimeline my-4/> -->
                </div>
                <!-- row 4 starts -->
            </div>
        </div>
    </app-layout>
</template>

<script>
import { ref, computed, watch, reactive } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'
import axios from 'axios'
import TransactionBox1 from '../Transactions/Components/TransactionBox1.vue'
import TransactionBox2 from '../Transactions/Components/KitInformation.vue'
import TransactionBox3 from '../Transactions/Components/CustomerInformation.vue'
import TransactionBox4 from '../Transactions/Components/PaymentInformation.vue'
import TransactionBox5 from '../Transactions/Components/Sms.vue'
import ItemTable from '../Transactions/Components/ItemTable.vue'
import TransactionTimeline from '../Transactions/Components/TransactionTimeline.vue'

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}

export default {
    components: {
        AppLayout,
        TransactionBox1,
        TransactionBox2,
        TransactionBox3,
        TransactionBox4,
        TransactionBox5,
        ItemTable,
        TransactionTimeline
    },
    props: {
        notifications: Array
    },

    setup (props) {
        const open = ref(false)
        const notifications = props.notifications

        return {
            statusStyles
        }
    }
}
</script>
