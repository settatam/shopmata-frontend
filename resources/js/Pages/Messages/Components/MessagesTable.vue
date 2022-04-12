<template>
    <!-- search row start-->
    <div class="grid grid-cols-2 gap-2 my-4 w-full md:grid-cols-5">
        <div class="mt-2 relative w-full text-black">
            <p class="ml-4 font-medium text-xl">Search Messages</p>
        </div>

        <div class="flex flex-col">
            <select
                name="Status"
                id=""
                class="rounded text-gray-500 text-xm md:text-base w-full bg-white border border-gray-200"
            >
                <option value="">All</option>
            </select>
        </div>
        <div class="flex flex-col">
            <div class="flex">
                <select
                    name="Tag"
                    id=""
                    class="rounded text-xm md:text-base text-gray-500 w-full bg-white border border-gray-200"
                >
                    <option value="active">All</option>
                </select>
            </div>
        </div>

        <div class="">
            <div
                class="relative w-full text-gray-400 focus-within:text-gray-600"
            >
                <div
                    class="absolute inset-y-0 left-0 flex items-center pointer-events-none"
                    aria-hidden="true"
                >
                    <SearchIcon class="h-5 w-5 ml-5" aria-hidden="true" />
                </div>
                <input
                    id="search-field"
                    name="search-field"
                    class="rounded text-xm md:text-base text-gray-500 w-full md:search-field md:w-full pl-12 pr-2 bg-white border border-gray-200 placeholder-gray-500 placehol"
                    placeholder="Search by order_id"
                    type="search"
                    v-model="filter.q"
                />
            </div>
        </div>

        <div class="flex">
            <div class="flex flex-row space-x-2">
                <button
                    class="bg-purple-darken px-5 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken inline-flex items-center"
                    type="submit"
                    @click="submit"
                >
                    Search
                </button>
            </div>
        </div>
    </div>

    <!-- search row ends -->

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
import { SearchIcon } from '@heroicons/vue/outline'
const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800'
}

export default {
    components: { AppLayout, Pagination, SearchIcon },
    props: ['messages'],
    setup ({ messages }) {
        const pagination = ref(messages)
        const filterLists = ref(messages.data)
        const loading = ref(false)

        const filter = reactive({
            selectOne: '',
            selectTwo: '',
            q: '',
            filter: true
        })

        function success (list, page) {
            filterLists.value = list
            pagination.value = page
            loading.value = false
        }

        function submit () {
            console.log('sent')
            loading.value = true
            axios
                .get('/messages', {
                    params: {
                        // selectOne:filter.from_date,
                        // selectTwo: filter.to_date,
                        q: filter.q,
                        filter: true
                    }
                })
                .then(res => {
                    const list = res.data.data
                    const page = res.data.meta
                    setTimeout(success(list, page), 2000)
                })
        }

        return {
            statusStyles,
            pagination,
            messages,
            filterLists,
            filter,
            submit,
            success
        }
    }
}
</script>
