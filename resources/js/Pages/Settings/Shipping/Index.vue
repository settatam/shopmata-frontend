<template>
    <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
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
                  <h1 class="text-2xl mb-2 font-semibold">Shipping and Delivery</h1>
                  <div class="p-8 mb-6 bg-white">
                      <h2 class="text-xl font-semibold">Delivery method at checkout</h2>
                      <p class="text-gray-500">Manage how customers receive their orders. Learn more about <span class="text-indigo-700 underline cursor-pointer">delivery methods.</span> </p>
                      <div class="pl-5 pr-2 border border-gray-300 mt-5 pt-8">
                        <p class="text-xl font-semibold">Shipping</p>
                        <p class="text-gray-500">Choose where you ship  and how much  you charge  for shipping at checkout. Learn more <span class="text-indigo-700 underline cursor-pointer">about shipping rates</span> </p>
                        <div class="flex justify-between items-center mt-6">
                          <div class="flex">
                            <p class="font-semibold uppercase mr-8">General Shipping Rate</p>
                            <p class="px-2 bg-gray-300 text-gray-500">Default</p>
                          </div>
                          <inertia-link href="shipping-and-delivery/general-shipping-rate">
                            <p class="text-indigo-700 mr-11 cursor-pointer">Manage rates</p>
                          </inertia-link>
                        </div>
                          <p> All Products</p>
                            <div class="flex flex-col mb-8">
                              <p class="font-semibold">Rates for</p>
                              <span class="flex"><GlobeAltIcon class="w-5 h-5 mr-3 my-auto text-gray-600"/> Domestic</span>
                              <span class="flex"><GlobeAltIcon class="w-5 h-5 mr-3 my-auto text-gray-600"/> Rest of the world</span>
                            </div>
                            <div class="border-t -mr-2 -ml-5 border-gray-300 bg-gray-100 px-5">
                            
                                <div class="flex justify-between items-center mt-6">
                                  <p class="font-semibold uppercase mr-8 mb-2">Custom shipping rates</p>
                                  <inertia-link href="shipping-and-delivery/shipping-profile">
                                    <p class="text-indigo-700 mr-5 cursor-pointer">Create new profile</p> 
                                  </inertia-link>
                                </div>
                              <p class="text-gray-500 pb-8">Create a shipping profile to add custom rates or destination restrictions for groups of products. Learn more about <span class="text-indigo-700 underline cursor-pointer">shipping profiles.</span></p>
                          
                            </div>
                      </div>
                      <div class="pl-5 pr-2 border border-gray-300 mt-5 py-8">
                        <p class="text-xl font-semibold">Local Delivery</p>
                        <p>Deliver orders directly to local customers. Learn more about <span class="text-indigo-700 underline cursor-pointer">local delivery.</span></p>
                        <div class="flex justify-between items-center mt-6">
                            <p class="font-semibold uppercase mr-8">MANAGE DELIVERY BY LOCATION</p>
                            <inertia-link href="shipping-and-delivery/local-delivery/manage">
                              <p class="text-indigo-700 mr-5 cursor-pointer">Manage</p> 
                            </inertia-link>
                        </div>
                        <p class="font-semibold">1, Road C Akinfenwa Street, Hope Road Old-Ife Road</p>
                        <p class="text-gray-500">1, Road C Akinfenwa Street, Hope Road Old-Ife Road, 200221 Ibadan Nigeria</p>
                      </div>
                      <div class="pl-5 pr-2 border border-gray-300 mt-7 py-8">
                        <p class="text-xl font-semibold">Local Pickup</p>
                        <p>Allow local customers to pick up their orders. Learn more about <span class="text-indigo-700 underline cursor-pointer">local pickup.</span></p>
                        <div class="flex justify-between items-center mt-6">
                            <p class="font-semibold uppercase mr-8">MANAGE DELIVERY BY LOCATION</p>
                            <p class="text-indigo-700 mr-5">Manage</p> 
                        </div>
                        <p class="font-semibold">1, Road C Akinfenwa Street, Hope Road Old-Ife Road</p>
                        <p class="text-gray-500">1, Road C Akinfenwa Street, Hope Road Old-Ife Road, 200221 Ibadan Nigeria</p>
                      </div>
                      <div class="border-t -mx-8 mt-5 border-gray-300"></div>
                      <div>
                        <p class="text-xl font-semibold mt-4">Packages</p>
                        <p class="text-gray-500">The <span class="text-indigo-700 underline cursor-pointer">package sizes</span> you use to ship your products. Weight and dimensions of the default package are used when calculating shipping rates at checkout. </p>
                        <div class="pl-5 pr-7 border border-gray-300 mt-7 py-4 rounded-sm">
                          <div class="flex justify-between items-center">
                                <p class="font-semibold text-xl uppercase mr-8">Saved Packages</p>
                                <p class="text-indigo-700">Add Package</p> 
                            </div>
                            <div class="flex justify-between items-center mt-4">
                              <div class="flex">
                                <BriefcaseIcon class="w-5 h-5 mr-4"/>
                                <div class="">
                                  <p>Sample box</p>
                                  <p>22 × 13.7 × 4.2 cm, 0 kg</p>
                                </div>
                              </div>
                              <p class="text-indigo-700 underline cursor-pointer">Edit</p>
                            </div>
                        </div>
                      </div>
                      <div class="pl-5 pr-7 border border-gray-300 mt-7 py-4 rounded-sm">
                          <div class="flex justify-between items-center">
                                <p class="font-semibold uppercase text-lg mr-8">Packing Slip</p>
                                <p class="text-indigo-700">Edit</p> 
                            </div>
                              <p class="text-gray-500 mt-3">A printed list of items in a shipment that often goes inside a package.</p>
                        </div>
                        <div class="border-t -mx-8 mt-5 border-gray-300"></div>
                         <p class="text-xl font-semibold mt-4">Accounts and Integrations</p>
                         <div class="pl-5 pr-7 border border-gray-300 mt-7 py-5 rounded-sm">
                          <div class="flex justify-between items-center">
                                <p class="font-semibold uppercase text-lg">Carrier accounts and fulfillment services</p>
                                <p class="text-indigo-700">Manage Integrations</p> 
                            </div>
                              <p class="text-gray-500 mt-3">Connect and manage external shipping carrier accounts and fulfillment services</p>
                        </div>
                  </div>
              </div>

              </div>
            </div>
          </div>
        </div>
    </app-layout>
</template>

<script>

import { ref } from 'vue'
import AppLayout from '../../../Layouts/AppLayout.vue'
import Search from '../../Search.vue'
import Nav from '../Nav';
import axios from "axios"

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon,GlobeAltIcon } from '@heroicons/vue/solid'
import { BriefcaseIcon } from '@heroicons/vue/outline'

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}
export default {
  props: {
            products: Object,
            filters: Object,
            brands: Array,
            categories: Array
        },
  
  components: {
    Nav,
    AppLayout,
    Dialog, DialogOverlay, TransitionChild, TransitionRoot,
    GlobeAltIcon,
    BriefcaseIcon
  },
  
  data() {
    return {

    }
  },
  setup() {
    const open = ref(false)
    return {
      statusStyles,
    }
  },

}
</script>

