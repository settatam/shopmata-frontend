<template>
  <app-layout>
      <nav aria-label="Breadcrumb" class="bg-white border-b border-blue-gray-200 xl:hidden">
            <div class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8">
                <inertia-link href="#" class="-ml-1 inline-flex items-center space-x-3 text-sm font-medium text-blue-gray-900">
                <ChevronLeftIcon class="h-5 w-5 text-blue-gray-400" aria-hidden="true" />
                <span>Settings</span>
                </inertia-link>
            </div>
        </nav>
        <div class="flex-1 flex xl:overflow-hidden">
            <!-- Secondary sidebar -->
            <Nav page="Shipping"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
                <div class="w-8.5/10 ml-5 max-w-2lg ">
                    <div class="mb-6 pt-2">
                        <h1 class="text-2xl font-semibold">Shipping and Delivery</h1>
                        <div class="p-8 mb-6 bg-white">
                          <h2 class="text-lg font-semibold">Local delivery for 1, Road C Akinfenwa Street, Hope Road Old-Ife Road</h2>  
                             <div class="my-3 rounded md:px-7 px-3 py-5 border border-gray-200">
                                <p class="font-semibold text-xl pb-5 pt-0.5">Location Status</p>
                                <div class="flex">
                                    <span class="mt-1.5 w-3"><img src="../../../../../assets/location-marker.svg" alt="location marker icon" /></span>
                                    <div class="ml-3">
                                        <p class="font-semibold mr-4 md:mb-0 mb-2">1, Road C Akinfenwa Street, Hope Road Old-Ife Road</p>
                                        <p class="text-gray-500 mt-2">1, Road C Akinfenwa Street, Hope Road Old-Ife Road, 200221 Ibadan Nigeria</p>
                                    </div>
                                </div>

                                <div class="md:flex justify-between w-full mt-4">
                                    <div class="md:w-7/10 w-full">
                                        <div class="flex w-full">
                                            <input aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded mr-3" v-model="localDelivery.offersLocalDelivery" />
                                            <label for="offersLocalDelivery" class="ml-2 block text-black cursor-pointer w-full">
                                                This location offers local delivery
                                            </label>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-4">* Delivery prices in this location are  in Nigerian Naira, which are subjected to the local currency of the country selected. </p>
                                    </div>
                                    <div class="md:w-3/10 w-full text-right">
                                        <t-button @click="handleShowCurrencyForm" class="text-indigo-700 cursor-pointer ">Change Currency</t-button>
                                    </div>
                                </div>
                            </div>

                            <div class="my-3 rounded md:px-7 px-3 py-5 border border-gray-200">
                                <p class="font-semibold text-xl pb-2 pt-0.5">Delivery Area</p>
                                <p class="text-gray-500">Use of the methods below to define your delivery area</p>
                                <div class="flex my-5">
                                    <input  type="radio" name="postalCodes" value="postalCodes" v-model="localDelivery.deliveryArea" id="postal-codes" class="cursor-pointer custom-form-radio mt-1">
                                    <label for="postal-codes" class="ml-3 block cursor-pointer w-full">
                                        <p class="text-black font-semibold">Postal Codes</p>
                                        <p class="text-gray-500">Choose specific areas that you deliver to.</p>
                                    </label>
                                </div>

                                <div class="flex my-5">
                                    <input type="radio" name="setRadius" value="setRadius" id="set-radius" v-model="localDelivery.deliveryArea" class="cursor-pointer custom-form-radio mt-1">
                                    <label for="set-radius" class="ml-3 block cursor-pointer w-full">
                                        <p class="text-black font-semibold">Set Delivery Radius</p>
                                        <p class="text-gray-500"> Set a distance around your location that you deliver to.</p>
                                    </label>
                                </div>

                                <p class="font-semibold text-xl pb-2 pt-0.5 md:mt-5">Delivery Zone</p>

                                <div class="flex flex-wrap md:mb-8">
                                    <div class="w-full ">
                                        <label class="block text-black mb-2 bg-transparent" for="zoneName">
                                            Zone name
                                        </label>
                                        <input class="appearance-none border  rounded-sm border-gray-200 bg-transparent w-full py-2 px-3 text-black leading-tight focus:outline-none " type="text" placeholder="Local delivery" v-model="deliveryZone.zoneName" required>
                                    </div>
                                </div>
                                <div class="flex flex-wrap md:mb-8">
                                    <div class="w-full">
                                        <label class="block text-black mb-2 bg-transparent" for="codes">
                                            Postal  codes
                                        </label>
                                        <input class="appearance-none border rounded-sm border-gray-200 bg-transparent w-full py-2 px-3 text-black leading-tight focus:outline-none " type="text" placeholder="" v-model="deliveryZone.postalCodes" required>
                                        <p class="text-gray-500 text-xs mt-0.5">Enter postal codes separated by a comma.</p>
                                    </div>
                                </div>
                                <div class="flex flex-wrap md:mb-4">
                                    <div class="w-full md:w-1/2 mb-8 md:pr-3">
                                        <label class="block text-black mb-2 bg-transparent" for="minOrderPrice">
                                            Minimum order price
                                        </label>
                                        <input class="appearance-none border rounded-sm border-gray-200 bg-transparent w-full py-2 px-3 text-black leading-tight focus:outline-none " type="number" placeholder="$0.00" v-model="deliveryZone.minOrderPrice" >
                                        <inertia-link href="" class="text-indigo-700 text-sm mt-2.5">Remove conditional pricing</inertia-link>
                                    </div>
                                    <div class="w-full md:w-1/2 mb-4 md:pl-3">
                                        <label class="block text-black mb-2 bg-transparent" for="deliveryPrice">
                                            Delivery price
                                        </label>
                                        <input class="appearance-none border border-gray-200 rounded-sm bg-transparent w-full py-2 px-3 text-black leading-tight focus:outline-none" type="number" placeholder="$0.00" v-model="deliveryZone.deliveryPrice" >
                                    </div>
                                </div>
                                <div class="flex flex-wrap">
                                    <div class="w-full mb-4 relative">
                                        <label class="block text-black mb-2 bg-transparent" for="deliveryInfo">
                                            Delivery information
                                        </label>
                                        <textarea name="deliveryInfo" rows="6" cols="30" class="appearance-none border border-gray-300 rounded bg-transparent w-full py-2 px-3 text-black leading-tight focus:outline-none " placeholder="" v-model="deliveryZone.deliveryInfo" />
                                        <div class="absolute md:bottom-8 bottom-12 md:right-7 right-4">
                                            <p class="text-gray-500 ">{{deliveryZone.deliveryInfo.length}}/255</p>
                                        </div>
                                        <p class="text-gray-500 text-sm">This message will appear at checkout and in the <inertia-link href="" class=" text-indigo-700">confirmation notification.</inertia-link></p>
                                    </div>
                                </div>

                                <inertia-link href="" class="flex md:mb-8 mb-4">
                                    <img src="../../../../../assets/theme-plus-icon.svg" alt="plus-icon"/>
                                    <p class="text-indigo-700 ml-4">Create new delivery zone</p>
                                </inertia-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </app-layout>
</template>

<script>
import AppLayout from '../../../../Layouts/AppLayout.vue'
import Search from '../../../Search.vue'
import Nav from '../../Nav';
export default {
  components: { AppLayout,Nav },

  data() {
        return{
            showCurrencyForm: true,
            localDelivery: {
                offersLocalDelivery: true,
                deliveryArea: "postalCodes"
            },
            deliveryZone: {
                zoneName: "",
                postalCodes: "",
                orderPrice: 0,
                deliveryPrice: 0,
                deliveryInfo: "",
            },
            currency: {
                currencyOption: "useDefault",
                currencyType: ""
            },
            options: [
                {
                    label: "Nigerian Naira(NGN)",
                    code: "NGN"
                }
            ]
        }
    },
    computed: {
        
    },
    methods: {
       
    }

}
</script>

<style>
</style>