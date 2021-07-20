<template>
<div class="bg-white pt-7 pb-1 mb-10">
    <div class="flex justify-between px-8 cursor-pointer" @click="expandForm">
        <p class="text-black font-semibold text-lg mb-6">Pricing</p>
        <span><angle-up-icon></angle-up-icon></span>
    </div>
    <div v-if="expand" class="px-8">
        <div class="mb-5 md:mb-10">
            <div class="flex flex-wrap mb-6">
                <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                    <label class="block text-black font-semibold mb-2 bg-transparent" for="price">
                        Price
                    </label>
                    <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none " type="number" placeholder="$ 0.00" step=".01" v-model="pricing.price">
                </div>
                <div class="w-full md:w-1/2 mb-6 md:mb-0 md:pl-3">
                    <label class="block text-black font-semibold mb-2 bg-transparent" for="compare_at_price">
                        Compare at price
                    </label>
                    <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none" type="number" step=".01" placeholder="$ 0.00" v-model="pricing.compare_at_price">
                </div>
            </div>
        </div>
        <div class="flex flex-wrap mb-6">
            <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                <label class="block text-black font-semibold mb-2 bg-transparent" for="cost_per_item">
                    Cost per item
                </label>
                <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none" type="number" step=".01" placeholder="$ 0.00" v-model="pricing.cost_per_item">
                <p class="text-gray-300 font-semibold flex items-center text-xs mt-2"><warning-icon></warning-icon><span class="mx-1">Customers won't see this</span></p>
            </div>
            <div class="w-full md:w-1/2 md:pl-3 mb-6 md:mb-0 flex flex-wrap">
                <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                    <label class="block text-black font-semibold mb-2 bg-transparent" >
                        Margin
                    </label>
                    <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none" type="number" step=".01" placeholder="" v-model="pricing.margin">
                </div>
                <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                    <label class="block text-black font-semibold mb-2 bg-transparent" >
                        Profit
                    </label>
                    <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none" type="number" step=".01" placeholder="" v-model="pricing.profit">
                </div>
            </div>
        </div>
        <div class="mt-8 mb-6">
            <div class="flex items-center">
                <input type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none" id="charge_tax">
                <label for="charge_tax" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                    Charge tax on this product
                </label>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import AngleUpIcon from '../../../../assets/AngleUpIcon'
import WarningIcon from '../../../../assets/WarningIcon'
export default {
     name: 'pricing-form',
    props: ['pricing'],
    components: {
        AngleUpIcon,
        WarningIcon
    },
    data() {
        return {
            expand: true
        }
    },
    methods: {
        expandForm() {
            this.expand = !this.expand;
        }
    }
}
</script>