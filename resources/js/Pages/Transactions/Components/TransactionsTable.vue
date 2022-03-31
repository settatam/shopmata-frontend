<template>
    <div class=" rounded-md bg-white mt-3 overflow-scroll lg:mx-2">
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
            <tbody>
                <tr>
                    <td
                        class="text-xs lg:text-sm font-light px-6 py-4 whitespace-nowrap text-purple-darken"
                    >
                        {{transaction.id}}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{transaction.created_at}}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{transaction.items[0].price}}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{transaction.items.length}}
                    </td>
                    <td
                        class=" text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{transaction.payment_method_id}}
                    </td>
                    <td
                        class=" text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        Kit Received
                    </td>
                </tr>
            </tbody>
        </table>

        
    </div>
</template>

<script>
import { reactive, ref } from '@vue/reactivity'
import AppLayout from '../../../Layouts/AppLayout.vue'
import AddItem from '../Components/AddItem.vue'

export default {
    components: { AppLayout, AddItem },
    props:['transaction'],
    setup () {
        return {}
    }
}
</script>
