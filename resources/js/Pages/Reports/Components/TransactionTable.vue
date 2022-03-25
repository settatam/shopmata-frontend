<template>
    <div class=" rounded-md bg-white mt-8 overflow-scroll lg:mx-2">
        <table class="min-w-full">
            <thead class="Kev table-auto border-b">
                <tr>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Website
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Bought
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Total Value
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Profit
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        AVG Kit Value
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        AVG Profit %
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        AVG Kits Received %
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        AVG Kits Declined %
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        AVG Kits Rejected %
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        AVG Kits Not Received %
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.index">
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        
                    </td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        
                    </td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        
                    </td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        
                    </td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        
                    </td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        
                    </td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        
                    </td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        
                    </td>
                </tr>
            </tbody>
        </table>

        
    </div>
</template>

<script>
import { reactive, ref } from '@vue/reactivity'

export default {

}
</script>
