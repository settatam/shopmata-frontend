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
                    Export
                </button>
            </div>
        </div>

        <table class="min-w-full">
            <thead class=" bg-purple-darken text-white table-auto border-b">
                <tr>
                    <th
                        class="text-xs lg:text-sm font-bold px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        #Tx ID
                        <SwitchVerticalIcon
                            class="h-5 w-5 ml-1 inline-flex cursor-pointer"
                        />
                    </th>
                    <th
                        class="text-xs lg:text-sm font-bold px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Bought
                        <SwitchVerticalIcon
                            class="h-5 w-5 ml-1 inline-flex cursor-pointer"
                        />
                    </th>
                    <th
                        class="text-xs lg:text-sm font-bold px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Estimated Value
                        <SwitchVerticalIcon
                            class="h-5 w-5 ml-1 inline-flex cursor-pointer"
                        />
                    </th>
                    <th
                        class="text-xs lg:text-sm font-bold px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Customer ID
                        <SwitchVerticalIcon
                            class="h-5 w-5 ml-1 inline-flex cursor-pointer"
                        />
                    </th>
                    <th
                        class="text-xs lg:text-sm font-bold px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        # of Trans
                        <SwitchVerticalIcon
                            class="h-5 w-5 ml-1 inline-flex cursor-pointer"
                        />
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-bold px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Status
                        <SwitchVerticalIcon
                            class="h-5 w-5 ml-1 inline-flex cursor-pointer"
                        />
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-bold px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Cstomer Since
                        <SwitchVerticalIcon
                            class="h-5 w-5 ml-1 inline-flex cursor-pointer"
                        />
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-bold px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Source
                        <SwitchVerticalIcon
                            class="h-5 w-5 ml-1 inline-flex cursor-pointer"
                        />
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-bold px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Keyword
                        <SwitchVerticalIcon
                            class="h-5 w-5 ml-1 inline-flex cursor-pointer"
                        />
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-bold px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Lead
                        <SwitchVerticalIcon
                            class="h-5 w-5 ml-1 inline-flex cursor-pointer"
                        />
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in table" :key="item.index">
                    <td
                        class="text-xs text-purple-darken lg:text-sm font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.txId }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        ${{ item.bought }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        ${{ item.estimatedValue }}
                    </td>
                    <td
                        class="text-xs lg:text-sm text-purple-darken font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.customerId }}
                    </td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.ofTrans }}
                    </td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.status }}
                    </td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.customerSince }}
                    </td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.source }}
                    </td>

                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.keyword }}
                    </td>

                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                        {{ item.lead }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { reactive, ref } from '@vue/reactivity'
import { SwitchVerticalIcon } from '@heroicons/vue/solid'

export default {
    components: {
        SwitchVerticalIcon
    },
    setup () {
        const table = reactive([
            {
                txId: 9859,
                bought: 0.00,
                estimatedValue: 0.00,
                customerId: 4360,
                ofTrans: 1,
                status: 'Kit-Sent',
                customerSince: '03-01-2022 3.27pm',
                source: 'goog',
                keyword: 'where to sell gold and silver near me',
                lead: ''
            },
            {
                txId: 9591,
                bought: 0.00,
                estimatedValue: 0.00,
                customerId: 4168,
                ofTrans: 2,
                status: 'Kit-Sent',
                customerSince: '02-17-2022 2:27pm',
                source: 'goog',
                keyword: 'buyer of gold near me',
                lead: 'google-CPC'
            },
            {
                txId: 9599,
                bought: 557.22,
                estimatedValue: 857.22,
                customerId: 4365,
                ofTrans: 1,
                status: 'Payment Processed ',
                customerSince: '03-02-2022 11:44am',
                source: 'goog',
                keyword: 'buy my gold',
                lead: 'google-CPC'
            },
            {
                txId: 9600,
                bought: 4200.00,
                estimatedValue: 4200.00,
                customerId: 4360,
                ofTrans: 4,
                status: 'Payment Processed ',
                customerSince: '12-13-2021 2:49pm',
                source: 'goog',
                keyword: 'buyer of gold',
                lead: 'google-CPC'
            },
            {
                txId: 9601,
                bought: 0.0,
                estimatedValue: 0.0,
                customerId: 4029,
                ofTrans: 2,
                status: 'Kit-Sent - 03-02-2022 12:50 pm',
                customerSince: '02-09-2022 8:34am',
                source: '',
                keyword: '',
                lead: 'google-CPC'
            }
        ])
        return { table }
    }
}
</script>
