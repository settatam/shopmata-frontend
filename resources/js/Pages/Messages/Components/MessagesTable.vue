<template>
    <div class=" rounded-md bg-white mt-3 overflow-x-auto lg:mx-2">
        <table class="min-w-full">
            <thead class="Kev table-auto border-b bg-purple-darken ">
                <tr class="">
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-4 text-left"
                        scope="col"
                    >
                        Transactions
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        From
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        To
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Messages
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="item in filterLists"
                    :key="item.index"
                    class="py-3 border-b border-gray-background mr-2"
                >
                    <td
                        class="text-xs lg:text-sm font-light px-6 py-4 whitespace-nowrap text-purple-darken"
                    >
                        {{ item.id }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.from }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.to }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4  whitespace-normal w-3/5 text-justify"
                    >
                        {{ item.message }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <pagination
            class="mx-3"
            :meta="pagination"
            v-if="pagination.total > pagination.per_page"
        />
    </div>
</template>

<script>
import { reactive, ref } from '@vue/reactivity'
import AppLayout from '../../../Layouts/AppLayout.vue'
import Pagination from '../../../Components/Pagination.vue'
const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}

export default {
    components: { AppLayout, Pagination },
    props: ['messages'],
    setup ({ messages }) {
        const pagination = ref(messages)
        const filterLists = ref(messages.data)
        function success (list, page) {
            filterLists.value = list
            pagination.value = page
            loading.value = false
        }

        return { pagination, messages, filterLists }
    }
}
</script>
