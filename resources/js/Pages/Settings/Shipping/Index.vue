<template>
    <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
           <div class="flex-shrink-0 mb-3 px-6 flex items-center">
              <p class="text-2xl font-semibold text-blue-gray-900">Settings</p>
            </div>
            <nav class="flex px-6" aria-label="Breadcrumb">
              <ol role="list" class="flex items-center space-x-4">
                <li>
                  <div>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                      <CogIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
                      <span class="sr-only">Settings</span>
                    </a>
                  </div>
                </li>
                <li v-for="page in pages" :key="page.name">
                  <div class="flex items-center">
                    <ChevronRightIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
                    <a :href="page.href" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" :aria-current="page.current ? 'page' : undefined">{{ page.name }}</a>
                  </div>
                </li>
              </ol>
            </nav>

          <div class="flex-1 flex xl:overflow-hidden">
            <!-- Secondary sidebar -->
            <Nav page="Shipping"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-9.5/10 ml-5 ">
                <div class="mb-6 pt-2 mt-2">
                  <h1 class="text-2xl mb-2 font-semibold">Shipping and Delivery</h1>
                  <div class="px-8 py-6 mb-6 bg-white">
                      <h2 class="text-xl font-semibold">Delivery method at checkout</h2>
                      <p class="text-gray-500">Manage how customers receive their orders. Learn more about <span class="text-indigo-700 underline cursor-pointer">delivery methods.</span> </p>
                      <div class="pl-5 pr-2 border border-gray-300 mt-5 pt-8 rounded-sm">
                        <p class="text-xl font-semibold">Shipping</p>
                        <p class="text-gray-500">Choose where you ship  and how much  you charge  for shipping at checkout. Learn more <span class="text-indigo-700 underline cursor-pointer">about shipping rates</span> </p>
                        <div class="flex justify-between items-center mt-6">
                          <div class="flex">
                            <p class="font-semibold uppercase mr-8">General Shipping Rate</p>
                            <p class="px-2 bg-gray-200 text-gray-400">Default</p>
                          </div>
                          <inertia-link href="shipping-and-delivery/general-shipping-rate">
                            <p class="text-indigo-700 mr-10 cursor-pointer text-right">Manage rates</p>
                          </inertia-link>
                        </div>
                          <p class="mt-2 text-gray-500"> All Products</p>
                            <div class="flex flex-col mb-8 mt-2">
                              <p class="font-semibold mb-3">Rates for</p>
                              <span class="flex text-gray-500 mb-1"><GlobeAltIcon class="w-5 h-5 mr-3 my-auto text-gray-400"/> Domestic</span>
                              <span class="flex text-gray-500 mt-1"><GlobeAltIcon class="w-5 h-5 mr-3 my-auto text-gray-400"/> Rest of the world</span>
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
                      <!-- <div class="pl-5 pr-2 border border-gray-300 mt-5 py-7 rounded-sm">
                        <p class="text-xl font-semibold ">Local Delivery</p>
                        <p class="text-gray-500 mt-2.5">Deliver orders directly to local customers. Learn more about <span class="text-indigo-700 underline cursor-pointer">local delivery.</span></p>
                        <div class="flex justify-between items-center mt-5 mb-2">
                            <p class="font-semibold uppercase mr-8">MANAGE DELIVERY BY LOCATION</p>
                            <inertia-link href="shipping-and-delivery/local-delivery/manage">
                              <p class="text-indigo-700 mr-5 cursor-pointer">Manage</p> 
                            </inertia-link>
                        </div>
                        <div class="flex justify-between">
                          <location-marker-icon class="w-5 h-5"/>
                          <div>
                            <p class="font-semibold">1, Road C Akinfenwa Street, Hope Road Old-Ife Road</p>
                            <p class="text-gray-500">1, Road C Akinfenwa Street, Hope Road Old-Ife Road, 200221 Ibadan Nigeria</p>
                          </div>
                          <p class="bg-green-200 text-green-500 px-2 py-1 text-sm h-6 -ml-24">Offer Delivery</p>
                        </div>
                      </div> -->
                      <div class="pl-5 pr-2 border border-gray-300 mt-5 py-7 rounded-sm">
                        <p class="text-xl font-semibold">Local Pickup</p>
                        <p class="mt-2.5 text-gray-500">Allow local customers to pick up their orders. Learn more about <span class="text-indigo-700 underline cursor-pointer">local pickup.</span></p>
                        <div class="flex justify-between items-center mt-5 mb-2">
                            <p class="font-semibold uppercase mr-8">MANAGE DELIVERY BY LOCATION</p>
                            <p class="text-indigo-700 mr-5 cursor-pointer">Manage</p> 
                        </div>
                        <div class="flex justify-between">
                          <location-marker-icon class="w-5 h-5"/>
                          <div>
                            <p class="font-semibold">1, Road C Akinfenwa Street, Hope Road Old-Ife Road</p>
                            <p class="text-gray-500">1, Road C Akinfenwa Street, Hope Road Old-Ife Road, 200221 Ibadan Nigeria</p>
                          </div>
                          <p class="bg-red-200 text-red-500 px-2 py-1 text-sm h-6 -ml-36">Doesnt Offer Delivery</p>
                        </div>
                      </div>
                      <!-- <div class="border-t -mx-8 mt-5 border-gray-300"></div>
                      <div>
                        <p class="text-xl font-semibold mt-4">Packages</p>
                        <p class="text-gray-500">The <span class="text-indigo-700 underline cursor-pointer">package sizes</span> you use to ship your products. Weight and dimensions of the default package are used when calculating shipping rates at checkout. </p>
                        <div class="pl-5 pr-7 border border-gray-300 mt-7 py-4 rounded-sm">
                          <div class="flex justify-between items-center">
                                <p class="font-semibold text-xl uppercase mr-8">Saved Packages</p>
                                <p class="text-indigo-700">Add Package</p> 
                            </div>
                            <div class="flex justify-between  mt-4">
                              <div class="flex items-center">
                                <BriefcaseIcon class="w-5 h-5 mr-4"/>
                                <div class=" text-gray-500">
                                  <p>Sample box</p>
                                  <p >22 × 13.7 × 4.2 cm, 0 kg</p>
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
                        </div> -->
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
import { ChevronLeftIcon,GlobeAltIcon,ChevronRightIcon,CogIcon } from '@heroicons/vue/solid'
import { BriefcaseIcon,LocationMarkerIcon } from '@heroicons/vue/outline'

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}
const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Shipping and Delivery', href: '/settings/shipping-and-delivery', current: true },
]
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
    Dialog, DialogOverlay, TransitionChild, TransitionRoot,ChevronRightIcon,CogIcon,
    GlobeAltIcon,
    BriefcaseIcon,
    LocationMarkerIcon
  },
  
  data() {
    return {

    }
  },
  setup() {
    const open = ref(false)
    return {
      statusStyles,
      pages
    }
  },

}
</script>

