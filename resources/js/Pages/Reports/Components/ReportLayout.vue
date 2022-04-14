<template>
    <div class=" rounded-md bg-white mt-4  lg:mx-2">
        <div class="grid grid-cols-3">
            <div v-for="data in storeData" :key="data.index" class="mx-auto ">
                <div class="flex flex-col py-12 justify-around">
                    <p class="text-gray-background text-xs">{{ data.tag }}</p>
                    <p class="text-3xl">
                        ${{ data.cost }}
                    </p>
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
                cost: '70,896'
            },
            {
                tag: 'PROFIT',
                cost: '70,896'
            }
        ])

        return { items, storeData }
    }
}
</script>
