<template>
    <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
           <div class="flex-shrink-0 mb-3 px-6 flex items-center">
              <p class="text-2xl font-semibold text-gray-900">Settings</p>
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
                      <div class="px-2 md:px-5  border border-gray-300 mt-5 pt-8 pb-12 rounded-sm">
                        <p class="text-xl font-semibold">Shipping</p>
                        <p class="text-gray-500">Choose where you ship  and how much  you charge  for shipping at checkout. Learn more <a class="text-indigo-700 underline cursor-pointer" href="/settings/shipping-rate">about shipping rates</a> </p>
                        <div class="flex justify-between items-center mt-6">
                          <div class="flex items-center">
                            <p class="font-semibold uppercase mr-8">Custom Shipping Rate</p>
                            <p class="px-2 bg-gray-200 text-gray-400">Default</p>
                          </div>
                          <inertia-link href="/settings/shipping-rates/create">
                            <button class="text-indigo-700 mr-5 cursor-pointer">Create Shipping Rate</button>
                          </inertia-link>
                        </div>
                          <span class="mt-2 mb-10 text-gray-500"> Create a shipping profile to add custom rates or destination restrictions for groups of products. 
                            <Tooltip :tooltipText="'A shipping profile enables you to decide how much you will charge your customer for shipping and also decide where you can ship to'">
                              <QuestionMarkCircleIcon class="h-5 w-5"/>
                            </Tooltip> 
                          </span>


            <div class="flex flex-col">
              <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="overflow-hidden">
                    <table class="min-w-full">
                      <thead class="border-b">
                        <tr>
                          <th scope="col" class="text-sm font-medium text-gray-600 px-5 mr-1 py-1 text-left">
                            <img class="w-5 h-5 " src="../../../../assets/globe.svg" alt="globe">
                          </th>
                          <th scope="col" class="text-sm font-medium text-gray-600 px-6 py-4 text-left">
                            Domestic
                          </th>
                          <th scope="col" class="text-sm font-medium text-gray-600 px-6 py-4 text-left">
                            Price
                          </th>
                          <th scope="col" class="text-sm font-medium text-gray-600 px-6 py-4 text-left">
                            Conditions
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="border-b"  v-for="(shipping, index) in shipping_rate" :key="shipping.id">
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-600">{{index + 1}}</td>
                          <td class="text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap">
                            {{shipping.name}}
                          </td>
                          <td class="text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap">
                            {{shipping.price}}
                          </td>
                          <td class="text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap ">
                            {{shipping.conditions.length}} condition(s)
                          </td>

                          <td class="text-sm text-gray-600 font-light px-6 py-4 whitespace-nowrap justify-end flex">
                            
                            <inertia-link :href="`/settings/shipping-rates/${shipping.id}/edit`">
                              <PencilIcon class="w-5 h-5 text-indigo-600 cursor-pointer mr-4"/>
                            </inertia-link>


                              <svg
                                        v-if="loading"
                                        role="status"
                                        class="mr-5 w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                        viewBox="0 0 100 101"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor"
                                        ></path>
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill"
                                        ></path>
                                    </svg>

                              <TrashIcon v-else @click="delete_Shipping(shipping.id)" class="w-5 h-5 text-red-500 cursor-pointer"/> 
                            

                            <delete-alert v-if="is_delete_shipping_rate" :delete_msg="this.delete_msg_shipping_rate" :open="open_delete" @close="emitClose" :id="shipping.id" :delete_url="delete_url_shipping_rate" />
                          </td>
                        </tr>
                      </tbody>
                    </table>
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
                            <span class="text-gray-500">Allow local customers to pick up their orders. Learn more about local pickup.
                              <Tooltip :tooltipText="'Customers can pick up their purchase from your physical store when you choose this option'">
                                <QuestionMarkCircleIcon class="h-5 w-5"/>
                              </Tooltip> 
                            </span>
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
                                <delete-alert v-if="is_delete_location" :delete_msg="this.delete_msg_location" :open="open_delete" @close="emitClose" :id="location.id" :delete_url="delete_url_location"/>
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
                                <PencilIcon class="w-5 h-5 text-indigo-600 cursor-pointer" @click="edit_shipping(location.id)"/>
                                <TrashIcon class="w-5 h-5 text-red-500 cursor-pointer" @click="delete_location"/>
                              </div>
                           </div>
                         </div>
                      </div>
                </div>
              </div>

                                  <NotificationGroup group="top" position="top">
                        <div
                            class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none"
                        >
                            <div class="w-full max-w-sm">
                                <Notification
                                    v-slot="{ notifications, close }"
                                    enter="transform ease-out duration-300 transition"
                                    enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                                    enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                                    leave="transition ease-in duration-500"
                                    leave-from="opacity-100"
                                    leave-to="opacity-0"
                                    move="transition duration-500"
                                    move-delay="delay-300"
                                >
                                    <div
                                        class="w-full max-w-sm mt-4 overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5"
                                        v-for="notification in notifications"
                                        :key="notification.id"
                                    >
                                        <div class="p-4">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <svg
                                                        class="w-6 h-6 text-green-400"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        aria-hidden="true"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div
                                                    class="ml-3 w-0 flex-1 pt-0.5"
                                                >
                                                    <p
                                                        class="font-semibold text-gray-800"
                                                    >
                                                        {{ notification.title }}
                                                    </p>
                                                    <p
                                                        class="text-sm font-semibold text-gray-500"
                                                    >
                                                        {{ notification.text }}
                                                    </p>
                                                </div>
                                                <div
                                                    class="flex flex-shrink-0 ml-4"
                                                >
                                                    <button
                                                        @click="
                                                            close(
                                                                notification.id
                                                            )
                                                        "
                                                        class="inline-flex text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
                                                    >
                                                        <span class="sr-only"
                                                            >Close</span
                                                        >
                                                        <svg
                                                            class="w-5 h-5"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20"
                                                            fill="currentColor"
                                                            aria-hidden="true"
                                                        >
                                                            <path
                                                                fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </Notification>
                            </div>
                        </div>
                    </NotificationGroup>

                    <NotificationGroup group="bottom" position="top">
                        <div
                            class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none"
                        >
                            <div class="w-full max-w-sm">
                                <Notification
                                    v-slot="{ notifications }"
                                    enter="transform ease-out duration-300 transition"
                                    enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                                    enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                                    leave="transition ease-in duration-500"
                                    leave-from="opacity-100"
                                    leave-to="opacity-0"
                                    move="transition duration-500"
                                    move-delay="delay-300"
                                >
                                    <div
                                        class="flex w-full max-w-sm mx-auto mt-4 overflow-hidden bg-white rounded-lg shadow-md"
                                        v-for="notification in notifications"
                                        :key="notification.id"
                                    >
                                        <div
                                            class="flex items-center justify-center w-12 bg-red-500"
                                        >
                                            <svg
                                                class="w-6 h-6 text-white fill-current"
                                                viewBox="0 0 40 40"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"
                                                ></path>
                                            </svg>
                                        </div>

                                        <div class="px-4 py-2 -mx-3">
                                            <div class="mx-3">
                                                <span
                                                    class="font-semibold text-red-500"
                                                    >{{
                                                        notification.title
                                                    }}</span
                                                >
                                                <p
                                                    class="text-sm text-gray-600"
                                                >
                                                    {{ notification.text }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </Notification>
                            </div>
                        </div>
                    </NotificationGroup>
            </div>
          </div>
        </div>
    </app-layout>
</template>

<script>
import { reactive, ref, onBeforeMount, computed } from 'vue'
import AppLayout from '../../../Layouts/AppLayout.vue'
import Search from '../../Search.vue'
import Nav from '../Nav';
import axios from "axios"
import PickUpModal from "./Components/PickUpModal.vue"
import PickUpModalEdit from "./Components/PickUpModalEdit.vue"
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon,GlobeAltIcon,ChevronRightIcon } from '@heroicons/vue/solid'
import { BriefcaseIcon,LocationMarkerIcon,HomeIcon,TrashIcon,PencilIcon,QuestionMarkCircleIcon } from '@heroicons/vue/outline'
import { Inertia } from '@inertiajs/inertia';
import DeliveryModal from './Components/DeliveryModal.vue';
import Tooltip from "../../../Components/Tooltip/Components/Tooltip.vue";
import DeleteAlert from '../../../Components/DeleteAlert.vue'

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
    QuestionMarkCircleIcon,
    Tooltip,
    DeleteAlert
  },

  
  data() {
    return {
      popUp :false,
      popUpEdit :false,
      delete_msg_location:"Are you sure you want to delete the selected location? The data will be removed and this action cannot be undone.",
      delete_url_location :'/settings/store-locations',
      delete_msg_shipping_rate:"Are you sure you want to delete the selected shipping rate? The data will be removed and this action cannot be undone.",
      delete_url_shipping_rate :'/settings/shipping-rates',
    }
  },
  
  setup(props) {
    const loading = ref(false)
    const store = props.store
    const open = ref(false)
    const local_delivery = ref(false)
    const Modal = ref(false)
    const is_delete_location = ref(false)
    const open_delete = ref(false)
    const is_delete_shipping_rate = ref(false)
    const shipping_rate = ref([])
    const popModal = () => {
      Modal.value = true
      }
    
    const delete_location =()=>{
      is_delete_location.value = true
      open_delete.value = true
    }
    const  emitClose=()=>{
        is_delete_location.value = false
        is_delete_shipping_rate.value = false
    }
    const local_pickup=props.locations
    onBeforeMount(()=>{
        axios.get('/settings/shipping-rates').then(res=>{
              shipping_rate.value=res.data.data
          })
        })
    const deleteShipping_rate = () =>{
      is_delete_shipping_rate.value = true
      open_delete.value = true
    }

    const edit_shipping = function(){
      
    }

    const delete_Shipping = (id) =>{
      axios.post(`/settings/shipping-rates/${id}`)
        .then(res=> {
                    Inertia.visit("/settings/shipping-and-delivery", {
                        method: "get",
                    });
                })
        .catch(error=> console.log(error))
        // loading.value = !loading.value
        // axios.post()
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
      deleteShipping_rate,
      is_delete_location,
      is_delete_shipping_rate,
      emitClose,
      open_delete,
      edit_shipping,
      delete_Shipping,
      loading
    }
  },

}
</script>

