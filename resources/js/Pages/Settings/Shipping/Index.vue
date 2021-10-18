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
                    <a href="/dashboard" class="text-gray-400 hover:text-gray-500">
                      <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
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

          <div class="flex-1 flex xl:overflow-hidden mt-5">
            <!-- Secondary sidebar -->
            <Nav page="Shipping"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-auto  lg:ml-7 lg:mr-2">
                <div class="mb-6">
                  <h1 class="text-2xl mb-2 font-semibold">Shipping and Delivery</h1>
                  <div class="px-8 py-6 mb-6 bg-white">
                      <h2 class="text-xl font-semibold">Delivery method at checkout</h2>
                      <p class="text-gray-500">Manage how customers receive their orders. Learn more about <span class="text-indigo-700 underline cursor-pointer">delivery methods.</span> </p>
                      <div class="pl-5 pr-2 border border-gray-300 mt-5 pt-8 rounded-sm">
                        <p class="text-xl font-semibold">Shipping</p>
                        <p class="text-gray-500">Choose where you ship  and how much  you charge  for shipping at checkout. Learn more <span class="text-indigo-700 underline cursor-pointer">about shipping rates</span> </p>
                        <div class="flex justify-between items-center mt-6">
                          <div class="flex">
                            <p class="font-semibold uppercase mr-8">Custom Shipping Rate</p>
                            <p class="px-2 bg-gray-200 text-gray-400">Default</p>
                          </div>
                            <button class="text-indigo-700 mr-5 cursor-pointer" @click='popModal'>Create Shipping Rate</button>
                          <!-- <inertia-link href="/settings/shipping-and-delivery/shipping-profile">
                          </inertia-link> -->
                        </div>
                          <p class="mt-2 mb-10 text-gray-500"> Choose shipping rates for both domestic and international delivery. </p>
                         <!--  <p class="mt-2 text-gray-500"> All Products</p>
                            <div class="flex flex-col mb-8 mt-2">
                              <p class="font-semibold mb-3">Rates for</p>
                              <span class="flex text-gray-500 mb-1"><GlobeAltIcon class="w-5 h-5 mr-3 my-auto text-gray-400"/> Domestic</span>
                              <span class="flex text-gray-500 mt-1"><GlobeAltIcon class="w-5 h-5 mr-3 my-auto text-gray-400"/> Rest of the world</span>
                            </div> -->
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
                      <div class="pl-5 pr-2  mt-5 py-7">
                        <div class="rounded-sm flex flex-col">
                          <div class="flex">
                          <input type="checkbox" id="" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2.5 mt-1" v-model="local_delivery"/>
                            <div class="flex justify-between items-center w-full">
                              <p class="text-xl font-semibold">Local Pickup</p> 
                              <p class="text-indigo-600 cursor-pointer" v-if="this.local_pickup.length!=0" @click="popModal=true">Add Location</p>
                            </div>
                          </div>
                          <div class="flex flex-col items-start mb-6 ml-6">
                            <p class="text-gray-500">Allow local customers to pick up their orders. Learn more about <span class="text-indigo-700 underline cursor-pointer">local pickup.</span></p>
                          </div>
                        </div>
                        <div class="flex flex-col items-center" v-if="this.local_pickup.length==0">
                          <p class="mt-8 mb-6">No local pickup address, add a location to select local pickup </p>
                          <button type="button" class=" h-12 w-40 rounded-md border border-transparent shadow-sm px-8 py-3 bg-indigo-600 text-base text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"  @click="popModal=true">Add location</button>
                        </div>
                         <div class="flex flex-col" v-else>
                           <div v-for="(location, index) in this.local_pickup" :key="location.id" class="bg-gray-50 border border-gray-300 h-32 pl-8 pr-7 mb-3 flex justify-between" >
                             <div class="flex flex-col">
                              <p class="font-bold mt-3 mb-2">Address {{index+1}}</p>
                              <div class="flex justify-between">
                                <div class="flex">
                                  <location-marker-icon class="w-7 h-7 mr-1 pt-2"/>
                                  <div class=" flex flex-col">
                                    <p class="font-bold">{{location.city}} Branch</p>
                                    <p class="text-gray-500">{{location.address}}</p>
                                  </div>
                                </div>
                              </div>
                             </div>
                              <div class="flex flex-col justify-between py-5">
                                <PencilIcon class="w-5 h-5 text-indigo-600 cursor-pointer" @click="edit_location(location.id)"/>
                                <TrashIcon class="w-5 h-5 text-red-500 cursor-pointer" @click="delete_location(location.id)"/>
                              </div>
                           </div>
                         </div>
                      </div>
                       <delivery-modal v-if="Modal" @close="Modal=false" :condition_options="condition_options" :rate_options="rate_options"/>
                      <!-- <pick-up-modal @close="this.popModal=false"  v-if="this.popModal" :store='store' /> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </app-layout>
</template>

<script>

import { reactive, ref } from 'vue'
import AppLayout from '../../../Layouts/AppLayout.vue'
import Search from '../../Search.vue'
import Nav from '../Nav';
import axios from "axios"
import PickUpModal from "./Components/PickUpModal.vue"
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon,GlobeAltIcon,ChevronRightIcon } from '@heroicons/vue/solid'
import { BriefcaseIcon,LocationMarkerIcon,HomeIcon,TrashIcon,PencilIcon } from '@heroicons/vue/outline'
import { Inertia } from '@inertiajs/inertia';
import DeliveryModal from './Components/DeliveryModal.vue'


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
  props: ['locations','store'],
  components: {
    Nav,
    AppLayout,
    Dialog, DialogOverlay, 
    TransitionChild, 
    TransitionRoot,
    ChevronRightIcon,
    HomeIcon,
    GlobeAltIcon,
    BriefcaseIcon,
    LocationMarkerIcon,
    PickUpModal,
    TrashIcon,PencilIcon,
    DeliveryModal
  },

  
  data() {
    return {
      //popModal : false,
      
    }
  },
  methods:{
    
  },

  setup(props) {
    const open = ref(false)
    const local_delivery = ref(false)
    const Modal = ref(false)
    const popModal = () => {
            Modal.value = true
      }
    const edit_location = function(id){
      console.log('edit',id)
    }
    const delete_location = function(id){
      Inertia.delete(`/settings/store-locations/${id}`)  
    }
    const local_pickup=props.locations
    
    return {
      statusStyles,
      pages,
      local_delivery,
      edit_location,
      delete_location,
      local_pickup,
      Modal,
      popModal
    }
  },

}
</script>

