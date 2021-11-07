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

          <div class="flex-1 flex flex-col xl:overflow-hidden lg:flex-row mt-5 px-4 lg:px-0">
            <!-- Secondary sidebar -->
            <Nav page="Shipping"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-auto  lg:ml-7 lg:mr-2">
                <div class="mb-6">
                  <h1 class="text-2xl mb-2 font-semibold">Shipping and Delivery</h1>
                  <div class="px-4 lg:px-8 py-6 mb-6 bg-white">
                      <h2 class="text-xl font-semibold">Delivery method at checkout</h2>
                       <p class="text-gray-500">Manage how customers receive their orders. </p>
                      <div class="pl-5 pr-2  border border-gray-300 mt-5 pt-8 pb-12 rounded-sm">
                        <p class="text-xl font-semibold">Shipping</p>
                        <p class="text-gray-500">Choose where you ship  and how much  you charge  for shipping at checkout. Learn more <a class="text-indigo-700 underline cursor-pointer" href="/settings/shipping-rate">about shipping rates</a> </p>
                        <div class="flex justify-between items-center mt-6">
                          <div class="flex items-center">
                            <p class="font-semibold uppercase mr-8">Custom Shipping Rate</p>
                            <p class="px-2 bg-gray-200 text-gray-400">Default</p>
                          </div>
                          <inertia-link href="/settings/shipping-and-delivery/shipping-profile">
                            <button class="text-indigo-700 mr-5 cursor-pointer">Create Shipping Rate</button>
                          </inertia-link>
                        </div>
                          <p class="mt-2 mb-10 text-gray-500"> Create a shipping a shipping profile to add custom rate </p>
                            <div class="mt-6 flex-col">
                                <div>
                                    <div class="flex-col mt-2">
                                        <div class="flex items-center text-gray-600">
                                            <div class="w-10 flex items-center"><img class="w-5 h-5 " src="../../../../assets/globe.svg" alt="globe"></div>
                                            <div class="w-3/10">Domestic</div>
                                            <div class="w-1/10 text-center">Price</div>
                                            <div class="min-w-max md:w-4/10 text-center hidden md:block">Conditions</div>
                                            <div class="min-w-max md:w-2/10 invisible">...</div>
                                        </div>
                                        <div class=" mt-1 border-t border-gray-100 -mr-5 -ml-8"></div>
                                        <div v-for="shipping in shipping_rate" :key="shipping.id">
                                          <div class="flex mt-1">
                                              <div class="w-10"></div>
                                              <div class="min-w-max md:w-3/10">{{shipping.name}}</div>
                                              <div class="min-w-max md:w-1/10 text-center">{{shipping.price}}</div>
                                              <div class="min-w-max md:w-4/10 text-center hidden md:block">{{shipping.conditions.length}} condition(s)</div>
                                              <div class="min-w-max md:w-2/10 cursor-pointer justify-between flex">
                                                <a class="text-indigo-700 underline" :href="`/settings/shipping-rates/${shipping.id}`" >Edit</a>
                                                <span class="text-red-600 underline mr-0  2xl:mr-52" @click="deleteShipping_rate(shipping.id)">Delete</span>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      </div>
                    
                </div>
                  <pick-up-modal @close="this.popUp=false" v-if="this.popUp"/>
                      <div class="pl-5 pr-2  mt-5 py-7 bg-white">
                        <div class="rounded-sm flex flex-col">
                          <div class="flex">
                          <input type="checkbox" id="" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2.5 mt-1" v-model="local_delivery"/>
                            <div class="flex justify-between items-center w-full">
                              <p class="text-xl font-semibold">Local Pickup</p> 
                              <p class="text-indigo-600 cursor-pointer" v-if="this.local_pickup.length!=0" @click="this.popUp=true">Add Location</p>
                            </div>
                          </div>
                          <div class="flex flex-col items-start mb-6 ml-6">
                            <p class="text-gray-500">Allow local customers to pick up their orders. Learn more about local pickup.</p>
                          </div>
                        </div>
                        <div class="flex flex-col items-center" v-if="this.local_pickup.length==0">
                          <p class="mt-8 mb-6">No local pickup address, add a location to select local pickup </p>
                          <button type="button" class=" h-12 w-40 rounded-md border border-transparent shadow-sm px-8 py-3 bg-indigo-600 text-base text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm"  @click="this.popUp = true">Add location</button>
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
                                  <pick-up-modal-edit @close="this.popUpEdit=false" :location='location.id' v-if="this.popUpEdit"  /> 
                              </div>
                             </div>
                              <div class="flex flex-col justify-between py-5">
                                <PencilIcon class="w-5 h-5 text-indigo-600 cursor-pointer" @click="edit_location(location.id)"/>
                                <TrashIcon class="w-5 h-5 text-red-500 cursor-pointer" @click="delete_location(location.id)"/>
                              </div>
                           </div>
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

import { reactive, ref, onBeforeMount } from 'vue'
import AppLayout from '../../../Layouts/AppLayout.vue'
import Search from '../../Search.vue'
import Nav from '../Nav';
import axios from "axios"
import PickUpModal from "./Components/PickUpModal.vue"
import PickUpModalEdit from "./Components/PickUpModalEdit.vue"
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
    PickUpModalEdit,
    TrashIcon,PencilIcon,
    DeliveryModal,
    
  },

  
  data() {
    return {
      popUp :false,
      popUpEdit :false,
      
    }
  },
  methods:{
     edit_location(){
      this.popUpEdit = true
    }
  },

  setup(props) {
    const open = ref(false)
    const local_delivery = ref(false)
    const Modal = ref(false)
    const shipping_rate = ref([])
    const popModal = () => {
            Modal.value = true
      }
    const delete_location = (id)=>{
      Inertia.delete(`/settings/store-locations/${id}`)
      location.reload()  
    }
    const local_pickup=props.locations
    onBeforeMount(()=>{
        axios.get('/settings/shipping-rates').then(res=>{
              shipping_rate.value=res.data.data
          })
        })
    const deleteShipping_rate = (id) =>{
      Inertia.delete(`/settings/shipping-rates/${id}`)
    }
  
    return {
      statusStyles,
      pages,
      local_delivery,
      delete_location,
      local_pickup,
      Modal,
      popModal,
      shipping_rate,
      deleteShipping_rate
    }
  },

}
</script>

