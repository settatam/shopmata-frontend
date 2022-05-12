<template>
    <div class=" rounded-md bg-white mt-4 overflow-x-auto lg:mx-2">
        <table class="min-w-full">
            <thead class="Kev table-auto border-b bg-purple-darken ">
                <tr class="">
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-4 text-left"
                        scope="col"
                    >
                        Transaction
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Date/Time
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Price
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Items
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Payment Type
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Status
                    </th>
                </tr>
            </thead>
            
            <tbody v-if="transactions.length > 0">
                <tr
                    v-for="transaction in transactions"
                    :key="transaction.index"
                >
                    <td
                        class="text-xs lg:text-sm font-light px-6 py-4 whitespace-nowrap text-purple-darken"
                    >
                        {{ transaction.id }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{
                            moment(transaction.updated_at).format('MM-DD-YYYY')
                        }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ transaction.final_offer }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    ></td>
                    <td
                        class=" text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ transaction.payment_method_id }}
                    </td>
                    <td
                        class=" text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ transaction.status_id }}
                    </td>
                </tr>
            </tbody>

            <tbody v-else class="">
                <p class="p-4 text-xl">This customer has no transactions</p>
            </tbody>
        </table>
    </div>
</template>

<script>
import { reactive, ref } from '@vue/reactivity'
import AppLayout from '../../../Layouts/AppLayout.vue'
import moment from 'moment'

export default {
    created: function () {
        this.moment = moment
    },
    components: { AppLayout },
    props: ['transactions'],
    setup () {
        return {}
    }
}
</script>
