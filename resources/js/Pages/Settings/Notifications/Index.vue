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
            <Nav page="Notifications"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
             <div class="w-auto  lg:ml-7 lg:mr-2">
                <div class="mb-6">
                  <h1 class="text-2xl font-semibold">Notifications</h1>
                  <p class="text-gray-500 mb-4">Choose which notifications you want to get for this site.</p>
                  <div class="p-8 mb-6 bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Orders</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openOrder" @click="openOrder=false" />
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-else @click="openOrder=true"/>
                    </div>
                    <div v-if="openOrder">
                      <div v-for="(order,index) in orders" :key="index" class="flex mb-5" >
                        <inertia-link href="/settings/notifications/order-confirmation" class="w-3/10 ">
                          <p class="font-bold text-indigo-700 no-underline cursor-pointer" >{{order.title}}</p>
                        </inertia-link>
                        <p class="text-gray-500 w-7/10">{{order.description}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Local Delivery</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openLocal" @click="openLocal=true"/>
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-else @click="openLocal=false"/>
                    </div>
                    <div v-if="openLocal">
                      <div v-for="(delivery,index) in localDeliveries" :key="index" class="flex mb-5">
                        <a class="font-bold text-indigo-700 no-underline w-3/10" href="">{{delivery.title}}</a>
                        <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2.5 my-auto" />
                        <p class="text-gray-500 w-7/10">{{delivery.description}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Shipping</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openShipping" @click="openShipping=false"/>
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-else  @click="openShipping=true"/>
                    </div>
                    <div v-if="openShipping">
                      <div v-for="(shipping,index) in shippings" :key="index" class="flex mb-5">
                        <a class="font-bold text-indigo-700 no-underline w-3/10" href="">{{shipping.title}}</a>
                        <p class="text-gray-500 w-7/10">{{shipping.description}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Local Pickup</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openPickup" @click="openPickup=false"/>
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openPickup==false"  @click="openPickup=true"/>
                    </div>
                    <div v-if="openPickup">
                      <div v-for="(pickup,index) in localPickups" :key="index" class="flex mb-5">
                        <p class="font-bold text-indigo-700 no-underline w-3/10" href="" @click="open">{{pickup.title}}</p>
                        <p class="text-gray-500 w-7/10">{{pickup.description}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Customer</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-if="openCustomer" @click="openCustomer=false"/>
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" v-else @click="openCustomer=true"/>
                    </div>
                    <div v-if="openCustomer">
                      <div v-for="(customer,index) in customers" :key="index" class="flex mb-5">
                        <a class="font-bold text-indigo-700 no-underline w-3/10" href="">{{customer.title}}</a>
                        <p class="text-gray-500 w-7/10">{{customer.description}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Email Marketing</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openMarketing=false" v-if="openMarketing"/>
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openMarketing=true" v-else/>
                    </div>
                    <div v-if="openMarketing">
                      <div v-for="(email,index) in emailMarketings" :key="index" class="flex mb-5">
                        <a class="font-bold text-indigo-700 no-underline w-3/10" href="">{{email.title}}</a>
                        <p class="text-gray-500 w-7/10">{{email.description}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="p-8 my-6  bg-white">
                    <div class="flex items-center justify-between mb-5">
                      <h2 class="font-bold text-xl ">Returns</h2>
                      <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openReturn=false" v-if="openReturn" />
                      <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openReturn=true" v-else />
                    </div>
                    <div v-if="openReturn">
                      <div v-for="(ret,index) in returns" :key="index" class="flex mb-5">
                        <a class="font-bold text-indigo-700 no-underline w-3/10" href="">{{ret.title}}</a>
                        <p class="text-gray-500 w-7/10">{{ret.description}}</p>
                      </div>
                    </div>
                  </div>
                  <h1 class="text-2xl font-semibold">Email Marketing</h1>
                  <p class="text-gray-500 mb-4">Choose consent and tracking options.</p>
                  <div class="p-8 my-6  bg-white">
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
                  <div class="p-8 my-6 bg-white">
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
                    <div class="p-8 my-6  bg-white">
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
                   <div class="p-8 my-6  bg-white">
                     
                      <div class="flex items-center justify-between mb-5">
                        <h2 class="font-bold text-xl ">Recipients</h2>
                        <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openRecipient=false" v-if="openRecipient"/>
                        <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openRecipient=true" v-else/>
                      </div>
                     <div v-if="openRecipient">
                      <div class="flex items-center justify-between mb-5"> 
                        <div>
                          <p class="text-indigo-700">Send test notification</p>
                          <p class="text-gray-500">Send email to "Esther Lagos" esthercoded@enkoded.com </p>
                        </div>
                        <button type="button" class=" inline-flex items-center px-7 py-3 font-semibold border border-indigo-500 rounded-md shadow-sm  bg-transparent text-indigo-500 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">Disable</button>
                      </div>
                     </div>
                   </div>
                   <div class="p-8 my-6  bg-white">
                      <div class="flex items-center justify-between mb-5">
                        <h2 class="font-bold text-xl ">Desktop Notification</h2>
                        <chevron-up-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openNotification=false" v-if="openNotification"/>
                        <chevron-down-icon class="w-6 h-6 text-indigo-700 cursor-pointer" @click="openNotification=true" v-else/>
                      </div>
                      <div v-if="openNotification">
                        <p class="text-gray-500">Get desktop notifications when you receive a new order. This setting only applies to your current browser — you must have the Shopify admin open in this browser to receive desktop notifications.</p>
                        <button type="button" class="mt-7 inline-flex items-center px-3 py-2 font-semibold border border-indigo-500 rounded-md shadow-sm  bg-transparent text-indigo-500 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">Enable Desktop Notifications</button>
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
            products: Object,
            filters: Object,
            brands: Array,
            categories: Array
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
      orders:{
        0:{
          title:"Order confirmation",
          description:"Sent automatically to the customer after they place their order."
        },
        1:{
          title: "Order edited",
          description:"Sent to the customer after their order is edited (if you select this option)."
        },
        2:{
          title:"Order edited invoice",
          description:"Sent automatically to the customer if their order is canceled (if you select this option)."
        },
        3:{
          title:"Order Invoice",
          description:"Sent to the customer when the order has an outstanding balance."
        },
        4:{
          title:"Order refund",
          description:"Sent automatically to the customer if their order is refunded (if you select this option)."
        },
        5:{
          title:"Draft order invoice",
          description:"Sent to the customer when a draft order invoice is created. You can edit this email invoice before you send it."
        },
        6:{
          title:"Email cart from POS",
          description:"Sent to the customer when you email their cart from POS. Includes a link to buy online."
        },
        7:{
          title:"Abandoned checkout",
          description:"Sent to the customer if they leave checkout before they buy the items in their cart. Configure options in checkout settings."
        },
        8:{
          title:"POS exchange receipt",
          description:"Sent to the customer after they complete an exchange in person and want to be emailed a receipt."
        },
        9:{
          title:"Gift card created",
          description:"Sent automatically to the customer when you issue or fulfill a gift card."
        },
        10:{
          title: "Payment error",
          description:"Sent automatically to the customer if their payment can’t be processed."
        }
      },
      localDeliveries:{
        0:{
          title: "Out of Delivery",
          description:"Sent to the customer when their local order is out for delivery."
        },
        1:{
          title: "Delivered",
          description:"Sent to the customer when their local order is delivered."
        },
        2:{
          title: "Missed Delivery",
          description:"Sent to the customer when they miss a local delivery."
        },
      },
      shippings:{
        0:{
          title:"Fulfilment request",
          description:"Sent automatically to a third-party fulfillment service provider when order items are fulfilled."
        },
        1:{
          title:"Shipping Confirmation",
          description:"Sent automatically to the customer when their order is fulfilled (if you select this option)."
        },
        2:{
          title:"Shipping update",
          description:"Sent automatically to the customer if their fulfilled order’s tracking number is updated (if you select this option)."
        },
        3:{
          title:"Out of Delivery",
          description:"Sent to the customer automatically after orders with tracking information are out for delivery."
        },
        4:{
          title:"Delivered",
          description:"Sent to the customer automatically after orders with tracking information are delivered."
        },
      },
      localPickups:{
        0:{
          title:"Ready for pickup",
          description:"Sent to the customer manually through Point of Sale or admin. Lets the customer know their order is ready to be picked up."
        },
        1:{
          title:"Picked up",
          description:"Sent to the customer when the order is marked as picked up."
        },
      },
      customers:{
        0:{
          title:"Customer account invite",
          description:"Sent to the customer with account activation instructions. You can edit this email before you send it."
        },
        1:{
          title:"Customer account welcome",
          description:"Sent automatically to the customer when they complete their account activation."
        },
        2:{
          title:"Customer account reset password",
          description:"Sent automatically to the customer when they ask to reset their accounts password."
        },
        3:{
          title:"Contact customer",
          description:"Sent to the customer when you contact them from the orders or customers page. You can edit this email before you send it."
        }
      },
      emailMarketings:{
        0:{
          title:"Confirmation email",
          description:"Sent to the customer automatically when they sign up for email marketing (if email double opt-in is enabled)."
        }
      },
      returns:{
         0:{
          title:"Return instruction",
          description:"Sent automatically to the customer when you create a return. Includes instructions as well as a return label, if applicable."
        },
        1:{
          title:"Return label instruction",
          description:"Sent to the customer after creating a return label."
        },
      },
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

