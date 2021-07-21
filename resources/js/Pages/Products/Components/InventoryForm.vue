<template>
    <div class="bg-white pt-7 pb-1 mb-10">
        <div class="flex justify-between px-8 cursor-pointer" @click="expandForm">
            <p class="text-black font-semibold text-lg mb-6">Inventory</p>
            <span><angle-up-icon></angle-up-icon></span>
        </div>
        <div v-if="expand" class="px-8">
            <div class="mb-8">
                <div class="flex flex-wrap mb-6">
                    <div class="w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
                        <label class="block text-black font-semibold mb-2 bg-transparent" for="page-title">
                            SKU(Stock Keeping Unit)
                        </label>
                        <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none" type="text" placeholder="" v-model="inventory.sku">
                    </div>
                    <div class="w-full md:w-1/2 mb-6 md:mb-0 md:pl-3">
                        <label class="block text-black font-semibold mb-2 bg-transparent" for="page-title">
                            Barcode (ISBN, UPC, GTIN, etc)
                        </label>
                        <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none" type="text" placeholder="" v-model="inventory.barcode">
                    </div>
                    <div class="mt-8 mb-6">
                        <div class="flex items-center">
                            <input v-model="inventory.track_quantity" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none" id="track_quantity">
                            <label for="track_quantity" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                                Track Quantity
                            </label>
                        </div>
                        <div class="flex items-center mt-4">
                            <input v-model="inventory.out_of_stock" type="checkbox" class="form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border border-border focus:outline-none" id="out_of_stock">
                            <label for="out_of_stock" class="ml-2 block text-sm leading-5 text-black cursor-pointer">
                                Continue selling when out of stock
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-gray-700 font-semibold text-lg mb-6">Quantity</p>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block text-gray-700 font-semibold mb-2 bg-transparent" for="page-title">
                        Available
                    </label>
                    <input class="appearance-none border border-border bg-transparent w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none" type="number" placeholder="0" v-model="inventory.quantity">
                </div>
            </div>
            <p class="text-gray-700 font-semibold text-lg mb-6">Category</p>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block text-black font-semibold mb-2 bg-transparent" for="level">
                        Category
                    </label>
                    <multiselect v-model="inventory.category" tag-placeholder="" placeholder="Pick a category" label="name" track-by="name" :close-on-select="true" :options="categories" :multiple="true"  class="text-xs text-black font-semibold"></multiselect>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";
// import 'vue-multiselect/dist/vue-multiselect.min.css'
import AngleUpIcon from '../../../../assets/AngleUpIcon'
export default {
    name: 'inventory-form',
    props: ['inventory', 'categories'],
    components: {
        AngleUpIcon,
        Multiselect
    },
    data() {
        return {
            expand: true
        }
    },
    methods: {
        expandForm() {
            this.expand = !this.expand;
        },
        added() {
            this.$emit('added');
        },
    }
}
</script>

<style scoped>

</style>
<style src="@vueform/multiselect/themes/default.css"></style>
