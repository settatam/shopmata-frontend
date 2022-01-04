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
            <Nav page="Notifications"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
             <div class="w-auto  lg:ml-7 lg:mr-2">
                <div class="mb-6">
                  <h1 class="text-2xl font-semibold">Notifications</h1>
                  <p class="text-gray-500 mb-4">Choose which notifications you want to get for this site.</p>
                  <div class="p-4 lg:p-8 mb-6 bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Orders</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openOrder" @click="openOrder=false" />
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-else @click="openOrder=true"/>
                    </div>
                    <div v-if="openOrder">
                      <div v-for="order in notifications.orders" :key="order.id" class="flex mb-5 flex-col md:flex-row" >
                        <inertia-link :href="`/settings/notifications/${order.id}`" class="w-full md:w-3/10 ">
                          <p class="font-bold text-indigo-700 no-underline cursor-pointer" >{{order.name}}</p>
                        </inertia-link>
                        <p class="text-gray-500 w-full md:w-7/10">{{order.description}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="p-4 md:p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Local Delivery</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openLocal" @click="openLocal=true"/>
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-else @click="openLocal=false"/>
                    </div>
                    <div v-if="openLocal">
                      <div v-for="delivery in notifications.deliveries" :key="delivery.id" class="flex flex-col md:flex-row mb-5">
                        <a class="font-bold text-indigo-700 no-underline w-full md:w-3/10" href="">{{delivery.name}}</a>
                        <div class="flex">
                          <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2.5 my-auto" />
                          <p class="text-gray-500 w-full">{{delivery.description}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="p-4 md:p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Shipping</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openShipping" @click="openShipping=false"/>
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-else  @click="openShipping=true"/>
                    </div>
                    <div v-if="openShipping">
                      <div v-for="shipping in notifications.shippings" :key="shipping.id" class="flex flex-col md:flex-row mb-5">
                        <a class="font-bold text-indigo-700 no-underline w-full md:w-3/10" href="">{{shipping.name}}</a>
                        <p class="text-gray-500 w-full md:w-7/10">{{shipping.description}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="p-4 md:p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Local Pickup</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openPickup" @click="openPickup=false"/>
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openPickup==false"  @click="openPickup=true"/>
                    </div>
                    <div v-if="openPickup">
                      <div v-for="pickup in notifications.pickups" :key="pickup.id" class="flex flex-col md:flex-row mb-5">
                        <p class="font-bold text-indigo-700 no-underline w-full md:w-3/10" href="" @click="open">{{pickup.name}}</p>
                        <p class="text-gray-500 w-full md:w-7/10">{{pickup.description}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="p-4 md:p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Customer</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openCustomer" @click="openCustomer=false"/>
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-else @click="openCustomer=true"/>
                    </div>
                    <div v-if="openCustomer">
                      <div v-for="customer in notifications.customers" :key="customer.id" class="flex flex-col md:flex-row mb-5">
                        <a class="font-bold text-indigo-700 no-underline w-full md:w-3/10" href="">{{customer.name}}</a>
                        <p class="text-gray-500 w-full md:w-7/10">{{customer.description}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="p-4 md:p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Email Marketing</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openMarketing=false" v-if="openMarketing"/>
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openMarketing=true" v-else/>
                    </div>
                    <div v-if="openMarketing">
                      <div v-for="email in notifications.marketings" :key="email.id" class="flex flex-col md:flex-row mb-5">
                        <a class="font-bold text-indigo-700 no-underline w-full md:w-3/10" href="">{{email.name}}</a>
                        <p class="text-gray-500 w-full md:w-7/10">{{email.description}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="p-4 md:p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Returns</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openReturn=false" v-if="openReturn" />
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openReturn=true" v-else />
                    </div>
                    <div v-if="openReturn">
                      <div v-for="(ret,index) in notifications.returns" :key="index" class="flex flex-col md:flex-row mb-5">
                        <a class="font-bold text-indigo-700 no-underline w-full md:w-3/10" href="">{{ret.name}}</a>
                        <p class="text-gray-500 w-full md:w-7/10">{{ret.description}}</p>
                      </div>
                    </div>
                  </div>
                  <h1 class="text-2xl font-semibold">Email Marketing</h1>
                  <p class="text-gray-500 mb-4">Choose consent and tracking options.</p>
                  <div class="p-4 md:p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <div>
                        <h2 class="font-bold text-xl">Double opt-in</h2>
                        <p class="text-gray-500 mt-3 mb-7">Get explicit consent from customers to send them email marketing. Learn more </p>
                        <span class="text-indigo-700 font-bold"><input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2.5" /> Require customers to confirm their subscription</span>
                        <p class="text-gray-500 mt-4">Customers who sign up will receive a confirmation email to validate their subscription. Previous subscribers will not be affected.</p>
                      </div>
                      <!-- <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer"/> -->
                    </div>
                  </div>
                  <div class="p-4 md:p-8 my-6 bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl">Shopmata Email open tracking</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openTracking=false" v-if="openTracking"/>
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openTracking=true" v-else/>
                    </div>
                    <div v-if="openTracking">
                        <p class="text-gray-500 mt-3 mb-7">Open tracking allows you to see how many emails are opened.</p> 
                        <div v-for="(track,index) in emailTracking" :key="index" class="flex flex-col my-5">
                          <div class="flex">
                             <input  type="radio" name="postalCodes" value="postalCodes"  class="cursor-pointer custom-form-radio mt-1 mr-2">
                            <p class="text-indigo-700 font-bold">{{track.title}}</p>
                          </div>
                          <p class="text-gray-500 w-full">{{track.description}}</p>
                        </div>
                    </div>
                  </div>
                  <h1 class="text-2xl font-semibold">Staff order notifications</h1>
                  <p class="text-gray-500 mb-4">Choose how you want to be <span class="text-indigo-700">notified</span>  when a new order comes in or add other recipients. You can also subscribe to the <span class="text-indigo-700">RSS</span> feed for this store's orders.</p>
                    <div class="p-4 md:p-8 my-6  bg-white">
                      <div class="flex items-center justify-between mb-5">
                        <h2 class="font-bold text-xl ">Templates</h2>
                        <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openTemplate=false" v-if="openTemplate"/>
                        <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openTemplate=true" v-else/>
                      </div>
                      <div v-if="openTemplate">
                        <p class="text-indigo-700">New Order</p>
                        <p class="text-gray-500">Sent to order notification subscribers when a customer places an order.</p>
                      </div>
                   </div>
                   <div class="p-4 md:p-8 my-6  bg-white">
                     
                      <div class="flex items-center justify-between mb-5">
                        <h2 class="font-bold text-xl ">Recipients</h2>
                        <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openRecipient=false" v-if="openRecipient"/>
                        <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openRecipient=true" v-else/>
                      </div>
                     <div v-if="openRecipient">
                      <div class="flex items-center justify-between mb-5 flex-col md:flex-row"> 
                        <div class="">
                          <p class="text-indigo-700">Send test notification</p>
                          <p class="text-gray-500">Send email to "Esther Lagos" esthercoded@enkoded.com </p>
                        </div>
                        <button type="button" class=" mt-7 md:mt-0 inline-flex items-center px-7 py-3 font-semibold border border-indigo-500 rounded-md shadow-sm  bg-transparent text-indigo-500 hover:bg-indigo-100">Disable</button>
                      </div>
                     </div>
                   </div>
                   <div class="p-4 md:p-8 my-6  bg-white">
                      <div class="flex items-center justify-between mb-5">
                        <h2 class="font-bold text-xl ">Desktop Notification</h2>
                        <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openNotification=false" v-if="openNotification"/>
                        <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openNotification=true" v-else/>
                      </div>
                      <div v-if="openNotification">
                        <p class="text-gray-500">Get desktop notifications when you receive a new order. This setting only applies to your current browser — you must have the Shopify admin open in this browser to receive desktop notifications.</p>
                        <button type="button" class="mt-7 inline-flex items-center px-3 py-2 font-semibold border border-indigo-500 rounded-md shadow-sm  bg-transparent text-indigo-500 hover:bg-indigo-100">Enable Desktop Notifications</button>
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
import { ChevronLeftIcon, ChevronUpIcon,ChevronDownIcon,ChevronRightIcon } from '@heroicons/vue/solid'
import {HomeIcon} from '@heroicons/vue/outline'

const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Notifications', href: '/settings/notifications', current: true },
]

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}
export default {
  props: {
            notifications:Object

        },
   emits:['close'],
  components: {
    Nav,
    AppLayout,
    Dialog,
    DialogOverlay,
    TransitionChild, 
    TransitionRoot,
    ChevronUpIcon,
    ChevronDownIcon,
    ChevronRightIcon,
    HomeIcon 
  },
  
  data() {
    return {
      openOrder:true,
      openLocal:true,
      openShipping:true,
      openPickup:true,
      openCustomer:true,
      openMarketing:true,
      openReturn:true,
      openTracking:true,
      openTemplate:true,
      openRecipient:true,
      openNotification:true,
      emailTracking:{
        0:{
          title:"Optimize open tracking (recommended)",
          description:"Track email open rates and maintain your sender reputation. Choose this option to balance customer privacy choices with data collection."
        },
        1:{
          title:"Do not track",
          description:"Your email open rate will not be reported. You will still be able to see other metrics, such as the number of clicks from subscribers in your emails."
        },
        2:{
          title:"Ask for content",
          description:"By default, email opens will not be tracked. Subscribers will be able to opt-in to tracking through the footer of your emails. Your open rate will be reported based on subscribers who opt-in, combined with overall engagement."
        },
        3:{
          title:"Track all email opens",
          description:"See how many subscribers open your emails. This will provide the most accurate reporting into open behavior."
        }
      }
    }
  },
  methods:{
    
  },
  setup() {
    return {
      statusStyles,
      pages,
    }
  },

}
</script>

