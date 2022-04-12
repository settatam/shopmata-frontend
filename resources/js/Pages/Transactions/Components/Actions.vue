<template>
    <div class=" rounded-md bg-white mb-4 overflow-x-auto lg:mx-2">
        <table class="table-fixed w-full">
            <thead class=" border-b bg-purple-darken ">
                <tr class="break-words">
                    <th
                        class="text-xs lg:text-sm font-medium  text-white px-5 mr-1 py-4 text-left"
                        scope="col"
                    >
                        Action
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium  text-white px-3 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Date/Time
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium  text-white px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Agent
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Communication
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1  py-1 text-left"
                        scope="col"
                    >
                        Offer
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-white px-5 mr-1  py-1 text-left"
                        scope="col"
                    >
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in transaction" :key="item.index">
                    <td
                        class="text-xs lg:text-sm font-light px-6 py-4 whitespace-nowrap text-purple-darken"
                    >
                        {{ item.name }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.created_at }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.agent }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-normal "
                    >
                        {{ item.notes }}
                    </td>
                    <td
                        class=" text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.offer }} 
                    </td>
                    <td
                        class=" text-xs lg:text-sm text-black font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.status }}
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
    props: ['transaction'],
    setup () {
        return {}
    }
}
</script>

<style scoped>
.fixthis {
    table-layout: fixed;
    width: 100%;
    white-space: nowrap;
}

.fixthis td {
    white-space: nowrap;
    overflow-wrap: break-word;
    /* overflow: hidden; */
    word-wrap: break-word;
    /* width: 2rem; */
}
</style>
