<template>
	<app-layout>
        <side-nav></side-nav>
        <order-modal @close="toggleModal" @addOrder="addOrders" v-if="showModal" :filter="filterProduct" />
        <div class="overflow-hidden md:w-3/5 w-full md:m-auto">
        <div class="my-10 mx-auto mt-32 md:ml-20">
            <alert v-if="notification" :notification="notification" />
            <div class="overflow-auto border-gray-100 md:grid md:grid-cols-5 gap-4">
                    <div class="md:col-span-3 bg-white mb-10 pt-7">
                        <div class="grid grid-cols-5 bg-white md:px-8 px-4 gap-2">
                            <div class="col-span-3 mb-10">
                                <h4 class="block text-black text-lg font-bold mb-2 bg-transparent" >
                                   <i class="fas fa-check-circle pr-4 dark-purple-color"></i> Fulfilled ( {{ order.items.length }} ) <small>#{{ order.id }}</small>
                                </h4>
                                <!-- <input class="search-bar border-solid border border-gray-400 text-4 py-2 pl-10 pr-2 placeholder-gray-400 focus:outline-none md:mr-2 mb-2 w-full" autocomplete="none"/> -->
                            </div>
                            <!-- <div class="col-span-2 mb-6">
                                <div class="px-2 py-2 text-center border border-gray-400 cursor-pointer mt-9" >
                                    Browse Products
                                </div>
                            </div> -->
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-5 bg-white md:px-8 px-4 gap-2 mb-10">
                            <div class="col-span-1 md:col-span-3">
                               <input class="search-bar border-solid border border-gray-400 text-4 py-2 pl-10 pr-2 placeholder-gray-400 focus:outline-none md:mr-2 mb-2 w-full" autocomplete="none"/>
                            </div>
                            <div class="col-span-1 md:col-span-2 flex justify-end">
                                <div class="md:flex-none w-1/2 md:w-full px-2 py-2 text-center border border-gray-400 cursor-pointer" @click="toggleModal">
                                    Browse Products
                                </div>
                            </div>
                        </div>

                        <div class="bg-white md:px-8 px-4 border-t-2 border-gray-200 py-4" v-if="order.items.length !== 0">
                            <div class="grid grid-cols-12 gap-2 py-2" v-for="product in order.items" :key="product.id">
                                <div class="col-span-4 md:col-span-1 cursor-pointer py-2 ">
                                    <img :src="product.images || '' " class="w-12 h-12 bg-gray-300 "/>
                                </div>
                                <div class="ccol-span-8 md:col-span-6 px-2 ">
                                    <div class="purple-color">
                                        {{ product.title || "" }}
                                    </div>
                                    <div class="text-gray-400">
                                        {{ product.brand ? product.brand.name : "" }} <br/>
                                        SKU: {{ product.sku }}
                                    </div>
                                </div>
                                <div class="col-span-10 md:col-span-5 text-center md:text-right">
                                    ${{ product.price }} X {{ product.quantity }} ${{ product.price }}
                                </div>
                            </div>
                        </div>

                        <div class="bg-white md:px-8 px-4 border-t-8 border-gray-200 pt-4">
                            <div class="py-4"  v-if="order.status === 'paid'">
                                 <h4 class="block text-black text-lg font-bold mb-2 bg-transparent" >
                                   <i class="fas fa-check-circle pr-4 dark-purple-color"></i> Paid
                                </h4>
                            </div>
                            <div class="grid grid-cols-8 gap-2 ">
                                <div class="col-span-2">
                                    <div class="block text-black py-2">
                                        Subtotal
                                    </div>
                                    <div class="block text-black py-2">
                                        Discount
                                    </div>
                                    <div class="block text-black py-2" >
                                        Shipping
                                    </div>
                                    <div class="block text-black py-2">
                                        Tax
                                    </div>
                                    <h4 class="block text-black text-lg font-bold mb-2 bg-transparent py-2" >
                                        Total
                                    </h4>
                                </div>
                                <div class="col-span-4 mdcol-span-5 mb-6">
                                    <div class="block text-gray-400 py-2">
                                        {{ order.items.length }} items
                                    </div>
                                    <div class="block text-gray-400 py-2" >
                                        
                                    </div>
                                    <div class="block text-gray-400 py-2">
                                      {{ order.shipping || "" }}
                                    </div>
                                    <div class="block text-gray-400 py-2">
                                        Tax %
                                    </div>
                                </div>
                                <div class="col-span-2 md:col-span-1 mb-6">
                                    <div class="block text-black py-2">
                                        ${{ order.sub_total }}
                                    </div>
                                    <div class="block text-black py-2"> 
                                        -${{ order.discount_cost || 0 }}
                                    </div>
                                    <div class="block text-black py-2">
                                        ${{ order.shipping_cost || 0 }}
                                    </div>
                                    <div class="block text-black py-2">
                                        ${{ order.sales_tax || 0 }}
                                    </div>
                                    <h4 class="block text-black text-lg font-bold mb-2 bg-transparent py-2" >
                                        ${{ order.total }}
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-6 bg-white md:px-8 px-4 gap-2 border-t-2 border-gray-200 pt-4">
                            <div class="col-span-4 md:col-span-5 mb-10">
                                Paid by customer
                            </div>
                            <div class="col-span-2 md:col-span-1 mb-6">
                                 ${{ order.total }}
                            </div>
                        </div>

                        <div class="border-t-2 border-gray-200 pt-4">
                            <div class="grid grid-cols-6 bg-white md:px-8 px-4 gap-2">
                                <div class="col-span-3 md:col-span-4 mb-10">
                                    <h4 class="block text-black text-lg font-bold mb-2 bg-transparent" >
                                        Timeline
                                    </h4>
                                </div>
                                <div class="col-span-3 md:col-span-2 mb-6">
                                    Show Comments
                                </div>                            
                            </div>
                        </div>

                         
                    </div>
                    <!-- Second Column -->
                    <div class="md:col-span-2 mb-10">
                        <div class="md:px-8 px-4 bg-white py-6">
                           <h4 class="block text-black text-lg font-bold mb-2 bg-transparent">
                                Notes
                            </h4>
                            <div> No notes from customer</div>
                        </div>

                        <div class="md:px-8 px-4 bg-white mt-4 py-6">
                           <h4 class="block text-black text-lg font-bold mb-2 bg-transparent">
                                Customer
                            </h4>                            
                        </div>

                        <div class="md:px-8 px-4 bg-white mt-4 py-6">
                           <h4 class="block text-black text-lg font-bold mb-2 bg-transparent">
                                Conversation Summary
                            </h4>                            
                        </div>

                        <div class="md:px-8 px-4 bg-white mt-4 py-6">
                            <div class="flex justify-between">
                                <div class="block text-black text-lg font-bold mb-2 bg-transparent">
                                    Tags
                                </div>
                                <div class="block text-black font-semibold mb-2 bg-transparent">
                                    View all tags
                                </div>
                            </div>
                            <input class="border-solid border border-gray-400 text-4 py-2 pl-5 pr-2 placeholder-gray-400 focus:outline-none md:mr-2 mb-2 w-full" placeholder="urgent, reviewed, wholesale" v-model="searchTags" autocomplete="none"/>
                        </div>
                    </div>
            </div>
            </div>

            <div class=" border-t-2 border-gray-400 flex justify-end my-4">
                <div class="px-2 py-2 border bg-red-500 cursor-pointer my-2" @click="submit">
                    Delete Order
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import axios from "axios"
    // import AppLayout from './../../Layouts/AppLayout'
    // import vueDropzone from 'vue2-dropzone'
    // import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    import UploadIcon from '../../../assets/UploadIcon'
    import AngleUpIcon from '../../../assets/AngleUpIcon'
    import Multiselect from 'vue-multiselect'
    import 'vue-multiselect/dist/vue-multiselect.min.css'
    import OrderModal from "./Components/OrderModal"
    import Alert from './../../Components/Alert'

	export default {
        name: 'AddProduct',
        data () {
            return {                
                formFields: {
                    title: '',
                    description: '',
                    brand: ''
                },
                filterProduct: "",
                note: "",
                searchCustomers: "",
                searchTags: "",
                image: "",
                orders: [],
                showModal: false,
                subTotal: 0,
                taxes: 0,
                total: 0,
                email: false,
                pending: false,
                paid: false         
            }
        },
        props: ['order', "notification"],
		components: {
            // AppLayout,
            OrderModal,
            vueDropzone,
            UploadIcon,
            AngleUpIcon,
            Multiselect,
            OrderModal,
            Alert
        },
        computed: {
            
        },
        methods: {
            
        },
        // mounted() {
        //     console.log(this.order)
        // },
	}
</script>

<style scoped>
@import 'style.css';

.purple-color {
    color: #923EA1;
}
.dark-purple-color {
    color: #632A6D;
}
.quill {
    display: flex;
    flex-direction: column;
}
</style>