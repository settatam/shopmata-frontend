<template>
    <div class=" rounded-md bg-white mt-4  lg:mx-2">
        <div class="grid grid-cols-3 ">
            <div v-for="data in storeData" :key="data.index" class="gap-3 border">
                <div class="flex flex-col py-12 justify-around text-center px-2">
                    <p class="text-gray-400 text-xs">{{ data.tag }}</p>
                    <p class="text-3xl">${{ data.cost }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-5 px-2 border">
            <div v-for="data in avgData" :key="data.index" class="mx-auto">
                <div class="flex flex-col py-6 justify-around">
                    <div class="">
                        <p class="text-gray-400 text-xs">{{ data.tag }}</p>
                        <p class="text-xl text-center pt-4">{{ data.cost }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from '@vue/reactivity'

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
            }
        ])

        const storeData = reactive([
            {
                tag: 'PURCHASED',
                cost: '70,896'
            },
            {
                tag: 'TOTAL VALUE',
                cost: '95,061'
            },
            {
                tag: 'PROFIT',
                cost: '24,165'
            }
        ])

        const avgData = reactive([
            { tag: 'AVG. KIT VALUES (USD)', cost: '20.00' },
            { tag: 'AVG. PROFIT (%)', cost: '35.00' },
            { tag: 'KITS RECEIVED (%)', cost: '20.00' },
            { tag: 'KITS DECLINED (%)', cost: '20.00' },
            { tag: 'KITS REJECTED (%)', cost: '20.00' }
        ])

        return { items, storeData, avgData }
    }
}
</script>
