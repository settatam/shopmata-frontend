<template>
  <app-layout >
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
           <div class="flex-shrink-0 mb-3 px-6 flex items-center">
              <p class="text-2xl font-semibold text-blue-gray-900">Settings</p>
            </div>
            <nav class="flex px-6" aria-label="Breadcrumb">
              <ol role="list" class="flex items-center space-x-4">
                <li>
                  <div>
                    <a href="dashboard" class="text-gray-400 hover:text-gray-500">
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
                         <div class="px-8 pb-8 pt-6  mb-6 bg-white">
                            <h1 class="text-2xl font-semibold">Manage Shipping Profile</h1>
                             <p class=" text-gray-500">Create a shipping profile to add custom rates </p>            
                                <div class="w-auto">
                                    <label class="block mt-4 mb-2 bg-transparent">
                                        Rate Name
                                    </label>
                                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder=""  required/>
                                </div>

                                   <!--  <div class="pl-5 pr-2 border border-gray-300 mt-7 py-8 rounded">
                                        <div class="flex justify-between items-center">
                                            <p class="font-semibold text-xl mr-8 mb-4">Shipping From</p>
                                        </div>
                                            <div class="flex justify-between">
                                                <location-marker-icon class="w-5 h-5 mr-1 pt-2"/>
                                                <div>
                                                    <p class="font-semibold">1, Road C Akinfenwa Street, Hope Road Old-Ife Road</p>
                                                    <p class="text-gray-500">1, Road C Akinfenwa Street, Hope Road Old-Ife Road, 200221 Ibadan Nigeria</p>
                                                </div>
                                                <p class="text-indigo-700 mr-5 cursor-pointer">Manage</p> 
                                            </div>
                                    </div> -->
                                   <!--  <div class="mt-6 border border-gray-300 pt-5 pl-8 pr-5 flex-col rounded">
                            <div class="flex justify-between mt-4 mb-2">
                                <h3 class="font-semibold text-xl">Shipping to</h3>
                                <inertia-link href="" class="text-indigo-700  cursor-pointer">Create Shipping zone</inertia-link>
                            </div>
                            <div class="flex w-3/4">
                                <div class="mr-2 mt-1"><img src="../../../../../assets/nigeria-flag.svg" alt="nigeria-flag"></div>
                                <div class="flex-col">
                                    <p class="pt-0 mt-0">Domestic</p>
                                    <p class="text-gray-400">Nigeria</p>
                                </div>
                            </div>
                            <div>
                                <div class="flex-col mt-2">
                                    <div class="flex justify-between">
                                        <div class="w-3/6">Rate name</div>
                                        <div class="w-1/6 text-center">Condition</div>
                                        <div class="w-1/6 text-center">Price</div>
                                        <div class="w-1/7 text-center invisible">...</div>
                                    </div>
                                    <div class=" mt-1 border-t border-gray-100 -mr-5 -ml-8"></div>
                                    <div class="flex text-gray-400 justify-between mt-1">
                                        <div class="w-3/6">Standard</div>
                                        <div class="w-1/6 text-center">-</div>
                                        <div class="w-1/6 text-center">Free</div>
                                        <div class="w-1/7 text-center">...</div>
                                    </div>
                                </div>
                                <button class="mt-4 w-28 h-14 mb-3 bg-gray-100">Add Rate</button>
                            </div>
                            <div class=" mt-1 border-t border-gray-100 -mr-5 -ml-8"></div>
                            <div class="flex w-3/4 mt-4">
                                <div class="mr-2 mt-1"><img src="../../../../../assets/globe.svg" alt="globe"></div>
                                <div class="flex-col">
                                    <p class="pt-0 mt-0">Rest of World</p>
                                    <p class="text-gray-400">Rest of World</p>
                                </div>
                            </div>
                                <div>
                                    <div class="flex-col mt-2">
                                        <div class="flex justify-between">
                                            <div class="w-3/6">Rate name</div>
                                            <div class="w-1/6 text-center">Condition</div>
                                            <div class="w-1/6 text-center">Price</div>
                                            <div class="w-1/7 text-center invisible">...</div>
                                        </div>
                                        <div class=" mt-1 border-t border-gray-100 -mr-5 -ml-8"></div>
                                        <div class="flex text-gray-400 justify-between mt-1">
                                            <div class="w-3/6">Standard</div>
                                            <div class="w-1/6 text-center">-</div>
                                            <div class="w-1/6 text-center">Free</div>
                                            <div class="w-1/7 text-center">...</div>
                                        </div>
                                    </div>
                                    <button class="mt-4 w-28 mb-5 h-14 bg-gray-100">Add Rate</button>
                                </div>       
                                    </div> -->
                                    <div class="pl-5 pr-2 border border-gray-300 mt-7 py-8  rounded">
                                        <div class="flex justify-between items-center mb-8">
                                            <p class="font-semibold text-xl mr-8">Shipping To</p>
                                            <button class="text-indigo-700 mr-5 cursor-pointer" @click='popModal'>Create Shipping Rate</button> 
                                        </div>
                                        <!-- <div class="flex items-center justify-around">
                                            <p class="text-gray-500">No data</p>
                                        </div> -->
                                        <div class="w-full">
                                            <div class="flex w-3/4">
                                                <div class="mr-2 mt-1"><img src="../../../../../assets/nigeria-flag.svg" alt="nigeria-flag"></div>
                                                <div class="flex-col">
                                                    <p class="pt-0 mt-0">Domestic</p>
                                                    <p class="text-indigo-700">Nigeria</p>
                                                </div>
                                            </div>
                                            <table class="w- lg:w-full" >
                                                <thead class=" border-b border-gray-200">
                                                <tr>
                                                    <th scope="col" class="px-6 py-2 font-normal text-base text-left  ">
                                                    State
                                                    </th>
                                                    <th scope="col" class="px-3 py-2 font-normal text-base text-center ">
                                                    City
                                                    </th>
                                                    <th scope="col" class="px-3 py-2 font-normal text-base text-center  ">
                                                    Conditions
                                                    </th>
                                                    <th scope="col" class="px-3 py-2 font-normal text-base text-center ">
                                                    Price
                                                    </th>
                                                    <th scope="col" class="px-3 py-2 font-normal text-center ">
                                                    Delivery Time
                                                    </th>
                                                    <th scope="col" class="relative px-6 py-2 font-normal text-base">
                                                    <span class="sr-only">Edit</span>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="location in local_locations" :key="location.id">
                                                    <td class="px-6 py-2  text-left font-medium text-gray-900">
                                                    {{ location.state }}
                                                    </td>
                                                    <td class="px-3 py-2  text-center text-gray-500">
                                                    {{ location.city }}
                                                    </td>
                                                    <td class="px-3 py-2  text-center text-gray-500">
                                                    {{ location.condition }}
                                                    </td>
                                                    <td class="px-3 py-2  text-center text-gray-500">
                                                    {{ location.price }}
                                                    </td>
                                                    <td class="px-3 py-2  text-center text-gray-500" >
                                                    {{ location.delivery_time }}
                                                    </td>
                                                    <td class="px-6 py-2  text-right font-medium relative">
                                                    <DotsHorizontalIcon class="w-6 h-6 cursor-pointer relative" @click="open_local_submenu(location.id)"/>
                                                        <div class="absolute top-12 -left-40 z-10 w-56  rounded-sm border border-gray-50 bg-white shadow-2xl px-7 py-5" v-show="current_local_row==location.id && open_local_sub">
                                                            <div class="text-gray-900 group flex items-center px-4 py-2 text-sm align-middle cursor-pointer">
                                                                <p class="text-gray-600"> Edit Shipping zone</p>
                                                            
                                                            </div>
                                                            <div href="#" class="text-gray-900 group flex items-center px-4 py-2 text-sm align-middle cursor-pointer">
                                                                <p class="text-red-600">Delete User</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="w-full mt-11">
                                            <div class="flex w-3/4">
                                                <div class="mr-2 mt-1"><img src="../../../../../assets/globe.svg" alt="globe"></div>
                                                <div class="flex-col">
                                                    <p class="pt-0 mt-0">International</p>
                                                    <p class="text-indigo-700">All countries</p>
                                                </div>
                                            </div>
                                            <table class="w- lg:w-full">
                                                <thead class=" border-b border-gray-200">
                                                <tr>
                                                    <th scope="col" class="px-6 py-2 font-normal text-base text-left  ">
                                                    State
                                                    </th>
                                                    <th scope="col" class="px-3 py-2 font-normal text-base text-center ">
                                                    City
                                                    </th>
                                                    <th scope="col" class="px-3 py-2 font-normal text-base text-center  ">
                                                    Conditions
                                                    </th>
                                                    <th scope="col" class="px-3 py-2 font-normal text-base text-center ">
                                                    Price
                                                    </th>
                                                    <th scope="col" class="px-3 py-2 font-normal text-center ">
                                                    Delivery Time
                                                    </th>
                                                    <th scope="col" class="relative px-6 py-2 font-normal text-base">
                                                    <span class="sr-only">Edit</span>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="location in local_locations" :key="location.id">
                                                    <td class="px-6 py-2  text-left font-medium text-gray-900">
                                                    {{ location.state }}
                                                    </td>
                                                    <td class="px-3 py-2  text-center text-gray-500">
                                                    {{ location.city }}
                                                    </td>
                                                    <td class="px-3 py-2  text-center text-gray-500">
                                                    {{ location.condition }}
                                                    </td>
                                                    <td class="px-3 py-2  text-center text-gray-500" >
                                                    {{ location.price }}
                                                    </td>
                                                    <td class="px-3 py-2  text-center text-gray-500">
                                                    {{ location.delivery_time }}
                                                    </td>
                                                    <td class="px-6 py-2  text-right font-medium relative">
                                                    <DotsHorizontalIcon class="w-6 h-6 cursor-pointer relative" @click="openSubMenu(location.id)"/>
                                                        <div class="absolute top-12 -left-40 z-10 w-56  rounded-sm border border-gray-50 bg-white shadow-2xl px-7 py-5" v-show="currentRow==location.id && openSub">
                                                            <div class="text-gray-900 group flex items-center px-4 py-2 text-sm align-middle cursor-pointer">
                                                                <p class="text-gray-600"> Edit Shipping zone</p>
                                                            
                                                            </div>
                                                            <div href="#" class="text-gray-900 group flex items-center px-4 py-2 text-sm align-middle cursor-pointer" @click="deleteRow(location.id)">
                                                                <p class="text-red-600">Delete</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                     <ConfirmationModal v-if="deleteConfirmation" :open="this.open" @close="emitClose" :id="this.location_id" />
                                    <div class="flex justify-between">
                                        <button class="text-gray-500 bg-transparent border border-gray-500 rounded-md px-8 py-2 font-normal text-base  my-5" >Cancel</button>
                                        <button class="text-white bg-indigo-700 rounded-md px-8 py-3 my-5 ml-5" >Save</button>
                                    </div> 
                                 </div>
                            </div>
                           <delivery-modal v-if="Modal" @close="Modal=false" :condition_options="condition_options" :rate_options="rate_options"/>
                </div>
            </div>
         </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '../../../../Layouts/AppLayout.vue'
import Nav from '../../Nav';
import {LocationMarkerIcon,ChevronRightIcon,HomeIcon,DotsHorizontalIcon} from '@heroicons/vue/outline'
import {reactive, ref} from 'vue'
import Button from '../../../../Jetstream/Button.vue';
import DeliveryModal from './DeliveryModal.vue'
import ConfirmationModal from './ConfirmationModal.vue'

const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Shipping and Delivery', href: '/settings/shipping-and-delivery', current: false },
  { name: 'Shipping Profile', href: '/settings/shipping-and-delivery/shipping-profile', current: true },
]
export default {
    props:['rate_options','condition_options'],
     components: {
        Nav,
        AppLayout,
        LocationMarkerIcon,ChevronRightIcon,HomeIcon,
          Button,
          DeliveryModal,
          DotsHorizontalIcon, 
          ConfirmationModal
    }, 
    data(){
        return{
            currentRow:0,
            openSub:false,
            current_local_row:0,
            open_local_sub:false,
            open:false,
            location_id:'',
            deleteConfirmation:false,
            hidden:true,
        }
    },
    methods:{
        openSubMenu(id){
            this.currentRow = id
            if (this.openSub==true) {
                this.openSub =false
            }else{
                this.openSub=true
                this.hidden = false
            }
        },
        open_local_submenu(id){
            this.current_local_row = id
            if (this.open_local_sub==true) {
                this.open_local_sub =false
            }else{
                this.open_local_sub=true
                this.hidden = false
            }
        },
        deleteRow(id){
            this.deleteConfirmation = true
            this.open = true
            this.location_id = id
        }, 
        hide(){
            console.log('clicked')
            this.hidden = !this.hidden
        }
    },
    setup(props){
        const Modal = ref(false)
        const popModal = () => {
            Modal.value = true
        }
        const local_locations = [{ id:0, state: 'Lagos', city: 'Egbeda', condition: '-', price: 'Free', delivery_time:'3-6 days' },]
         const conditions = props.condition_options
        const rate = props.rate_options
        return{
            pages,
            Modal,
            popModal,
            local_locations, 
            rate,
            conditions
        }
    }
}
</script>

<style>
</style>