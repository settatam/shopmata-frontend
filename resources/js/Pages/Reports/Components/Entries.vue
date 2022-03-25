<template>
    <div class=" rounded-md bg-white mt-4 overflow-scroll lg:mx-2">
        <div class="flex flex-row justify-between mx-3">
            <div class="flex my-2 flex-row space-x-2 ">
                <div>
                    <p class="pt-2">Show</p>
                </div>
                <select
                    class="rounded text-gray-500 text-xm md:text-base w-20 bg-transparent border border-gray-200"
                    name=""
                    id=""
                >
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                </select>
            </div>

            <div class="my-2">
                <button
                    class="bg-purple-darken px-2 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-purple-darken focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-darken inline-flex items-center"
                    type="submit"
                >
                    Add Customer
                </button>
            </div>
        </div>

        <table class="min-w-full">
            <thead class="Kev table-auto border-b">
                <tr>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        #Tx ID
                        <SwitchVerticalIcon class="h-5 w-5 ml-1 inline-flex cursor-pointer"/>
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Bought
                        <SwitchVerticalIcon class="h-5 w-5 ml-1 inline-flex cursor-pointer"/>
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Customer ID
                        <SwitchVerticalIcon class="h-5 w-5 ml-1 inline-flex cursor-pointer"/>
                    </th>
                    <th
                        class="text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        # of Trans
                        <SwitchVerticalIcon class="h-5 w-5 ml-1 inline-flex cursor-pointer"/>
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Status
                        <SwitchVerticalIcon class="h-5 w-5 ml-1 inline-flex cursor-pointer"/>
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Cstomer Since
                        <SwitchVerticalIcon class="h-5 w-5 ml-1 inline-flex cursor-pointer"/>
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Source
                        <SwitchVerticalIcon class="h-5 w-5 ml-1 inline-flex cursor-pointer"/>
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Keyword
                        <SwitchVerticalIcon class="h-5 w-5 ml-1 inline-flex cursor-pointer"/>
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Lead
                        <SwitchVerticalIcon class="h-5 w-5 ml-1 inline-flex cursor-pointer"/>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.index">
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    ></td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    ></td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    ></td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    ></td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    ></td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    ></td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    ></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { reactive, ref } from '@vue/reactivity'
import { SwitchVerticalIcon } from '@heroicons/vue/solid'

export default {
    components:{
        SwitchVerticalIcon
    }
}
</script>
