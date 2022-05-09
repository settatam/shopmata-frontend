<template>
    <div class=" rounded-md bg-white mt-4 overflow-x-auto overflow-y-auto overflow-scroll lg:mx-2">
        <table class="min-w-full">
            <thead class=" border-b bg-white ">
                <tr>
                    <th
                        class="text-xs lg:text-sm font-bold text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Website
                    </th>
                    <th
                        class="text-xs lg:text-sm font-bold text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Bought
                    </th>
                    <th
                        class="text-xs lg:text-sm font-bold text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Total Value
                    </th>
                    <th
                        class="text-xs lg:text-sm font-bold text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        Profit
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-bold text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        AVG Kit Value
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-bold text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        AVG Profit %
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-bold text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        AVG Kits Received %
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-bold text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        AVG Kits Declined %
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-bold text-gray-600 px-5 mr-1 py-1 text-left"
                        scope="col"
                    >
                        AVG Kits Rejected %
                    </th>
                    <th
                        class="hidden lg:table-cell text-xs lg:text-sm font-bold text-gray-600 px-5 mr-1 py-1 text-left"
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
                    {{item.website}}</td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >
                    ${{item.bought}}</td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >${{item.totalValue}}</td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >${{item.profit}}</td>
                    <td
                        class="text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >${{item.avgKitValue}}</td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >{{item.avgProfit}}%</td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >{{item.avgKitsReceived}}%</td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >{{item.avgKitsDeclined}}%</td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >{{item.avgKitsRejected}}%</td>
                    <td
                        class="hidden lg:table-cell text-xs lg:text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap"
                    >{{item.avgKitsNotReceived}}%</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { reactive, ref } from '@vue/reactivity'

export default {
    setup () {
        const items = reactive([
            {
                website: 'BMG',
                bought: '70,896.01',
                totalValue: '95,061.96',
                profit: '24,165.96',
                avgKitValue: '581.11',
                avgProfit: '34.09',
                avgKitsReceived: '27.35',
                avgKitsDeclined: '13.93',
                avgKitsRejected: '9.84',
                avgKitsNotReceived: '72.65'
            },
            {
                website: 'SMJ',
                bought: '32,956.01',
                totalValue: '85,675.92',
                profit: '48,165.09',
                avgKitValue: '543.73',
                avgProfit: '22.07',
                avgKitsReceived: '16.37',
                avgKitsDeclined: '16.44',
                avgKitsRejected: '8.22',
                avgKitsNotReceived: '83.63'
            }
        ])

        return { items }
    }
}
</script>
