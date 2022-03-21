<template>
    <app-layout>
        <div id="container">
            <div
                class="bg-gray-background w-full flex flex-col lg:space-y-8 px-4"
            >
                <!-- container for  containers -->
                <div class="flex flex-col lg:flex-row w-full h-full">
                    <div class="w-full lg:w-1/3">
                        <TransactionBox1 class="my-4 h-full" />
                    </div>
                    <div class="w-full lg:w-1/3">
                        <KitInformation class="my-4 h-full" />
                    </div>
                    <div class="w-full lg:w-1/3 h-full">
                        <div>
                            <CustomerInformation class="my-4 h-full" />
                        </div>
                        <div>
                            <PaymentInformation class="my-4 h-full" />
                        </div>
                        <div>
                            <TrafficSource class="my-4 h-full" />
                        </div>
                    </div>
                </div>

                <!-- row 2 -->
                <!-- <div class=" w-full flex flex-col lg:flex-row h-full">
                    
                </div> -->

                <!-- row 3 -->
                <div class="w-full">
                    <ItemTable class="my-4" />
                </div>
                <!-- row 3 ends -->

                <!-- row 4 -->
                <div class="w-full">
                    <TransactionTimeline class="my-4" />
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
import KitInformation from '../Transactions/Components/KitInformation.vue'
import CustomerInformation from '../Transactions/Components/CustomerInformation.vue'
import PaymentInformation from '../Transactions/Components/PaymentInformation.vue'
import TransactionTimeline from '../Transactions/Components/TransactionTimeline.vue'
import ItemTable from '../Transactions/Components/ItemTable.vue'
import TrafficSource from '../Transactions/Components/TrafficSource.vue'

const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}

export default {
    components: {
        AppLayout,
        TransactionBox1,
        KitInformation,
        CustomerInformation,
        PaymentInformation,
        TransactionTimeline,
        ItemTable,
        TrafficSource
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
