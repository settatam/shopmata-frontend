<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!--
        Background overlay, show/hide based on modal state.

        Entering: "ease-out duration-300"
            From: "opacity-0"
            To: "opacity-100"
        Leaving: "ease-in duration-200"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
            From: "opacity-100 translate-y-0 sm:scale-100"
            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
           <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
               <div class="flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                        Select Products
                    </h3>
                </div>
                <div @click="cancel" class="cursor-pointer">
                    X
                </div>
                </div>
                
                <div class="mt-2">
                    <div class="grid grid-cols-6 bg-white gap-2">
                            <div class="col-span-4 mb-10">
                                <input class="search-bar border-solid border border-gray-400 text-4 py-2 pl-10 pr-2 placeholder-gray-400 focus:outline-none md:mr-2 mb-2 w-full" v-debounce:1000ms="getProducts" placeholder="Search Products" v-model="filterProduct" autocomplete="none"/>
                            </div>
                            <div class="col-span-2 mb-6">
                                <select class="px-2 py-2 text-center border border-gray-400 cursor-pointer bg-white" v-model="status">
                                    <option value="">All Products </option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="loading" v-if="loading">
                     <i class="fas fa-spinner fa-pulse"></i>
                </div>

                <div class="bg-white border-t-2 border-gray-200 py-4 product-list" v-if="products.length !== 0">
                    <div class="grid grid-cols-8 gap-2 py-2" v-for="product in products" :key="product.id">
                        <div class="col-span-2 cursor-pointer">
                            <div class="grid grid-cols-5">
                                <div class="col-span-2 py-4">
                                    <input type="checkbox" class="mx-4 block form-checkbox cursor-pointer rounded-none h-4 w-4 text-purple-darker transition duration-150 ease-in-out border-gray-400 focus:outline-none" @click="addProduct(product)">
                                </div>
                                <div class="col-span-3">
                                    <img :src="product.images[0].image_url || '' " class="w-12 h-12 bg-gray-300 "/>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-3">
                            <div class="px-2 py-2 font-bold purple-color">
                                {{ product.title }}
                            </div>
                        </div>
                        <div class="col-span-2 text-center">
                            $ {{ product.compare_at_price }}
                        </div>
                    </div>
                </div>
                <div v-else > <p> No Products Found </p> </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button type="button" @click="addOrder" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base purple-bkground font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Add to Order
            </button>
            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="cancel">
                Cancel
            </button>
        </div>
        </div>
    </div>
    </div>
</template>
<script>
import axios from "axios"
export default {
    props: {
        filter: String
    },
    data() {
        return {
           filterProduct: "",
           status: "",
           products: [],
           loading: false,
           selectedProducts: []
        }
    },
    methods: {
        cancel(){
            this.$emit('close')
        },
        async getProducts() {
            this.loading = true
            const products = await axios.post('/products/get-order-products', { search: this.filterProduct  })
            this.products = products.data.data
            this.loading = false
        },
        addProduct(product){
            const ifProduct = this.selectedProducts.filter(item => item.id === product.id)
            ifProduct.length > 0 ? this.selectedProducts = this.selectedProducts.filter(item => item.id !== product.id) : this.selectedProducts.push({...product, quantityOrdered: 1})
        },
        addOrder(){
            this.$emit('addOrder', this.selectedProducts)
        }
    },
    async mounted(){
        if(this.filter) this.filterProduct = this.filter
        await this.getProducts()
    }
}
    
</script>
<style scoped>
.purple-bkground {
    background-color: #923EA1 !important;
}
.product-list{
    height: 500px;
    overflow-x: scroll;
}
</style>
<style src="../style.css"></style>
