<template>
    <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto ">
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

          <div class="flex-1 flex flex-col  lg:flex-row mt-5 px-4 lg:px-">
            <!-- Secondary sidebar -->
            <Nav page="Payments"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen">
              <div class="w-auto  lg:ml-7 lg:mr-2">
                <div class=" p-4 md:p-8 bg-white rounded-md mb-6">
                  <div class="flex md:flex-row flex-col justify-between">
                  <h1 class="text-2xl mb-2 font-semibold">Payments</h1>
                    <div class="flex flex-wrap">
                      <p class="text-gray-400 mr-4">Your business is located in </p>
                      <!-- Dynamically Change Location -->
                      <p class="mr-2 text-indigo-700 underline">{{country()}}</p>
                      <Tooltip :tooltipText="'You can change your store location if you choose'">
                        <QuestionMarkCircleIcon class="text-indigo-700 w-5 h-5 cursor-pointer"/>
                      </Tooltip>
                    </div>
                  </div>
                  <p class="text-gray-400">
                    View and manage the payment methods in your account. Based on your country, these options have been selected. You can always add more, or change providers later.
                  </p>
                </div>
                <div class="p-3 md:px-7 pt-7 pb-3 bg-white rounded-md mb-6">
                  <div class="flex justify-between items-center">
                  <span class=" text-xl md:text-2xl mb-2 font-semibold flex items-center ">Pay on Delivery 
                    <Tooltip :tooltipText="'By enabling this option, customers will pay after receiving their orders'">
                      <QuestionMarkCircleIcon class="w-5 h-5  md:ml-2"/>
                    </Tooltip>
                  </span>
                      <Switch v-model="enabledPayment" :class="[enabledPayment ? 'bg-indigo-600' : 'bg-gray-500', 'relative inline-flex flex-shrink-0 h-6 w-24 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 ']">
                        <span class="sr-only">Use setting</span>
                        <span :class="[enabledPayment ? 'translate-x-20' : 'translate-x-0', 'pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']">
                          <span :class="[enabledPayment ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200', 'absolute inset-0 h-full w-full flex items-center justify-start transition-opacity text-white ml-6']" aria-hidden="true">
                            Disabled
                          </span>
                          <span :class="[enabledPayment ? 'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100', 'absolute inset-0 h-full w-full flex items-center justify-end transition-opacity text-white -ml-6']" aria-hidden="true">
                            Enabled
                          </span>
                        </span>
                      </Switch>
                  </div>
                 <div v-if="enabledPayment" class="mt-6  bg-green-50 border border-green-400  py-4 px-7 rounded">
                   <p class="text-lg font-bold ">Pay on Delivery is enabled!</p>
                   <p class="">Receive cash from your customers when you deliver their order.</p>
                 </div>
                </div>
                <PaymentModal @close="this.popModal=false"  v-if="this.popModal"/>
                <div class="px-3 md:px-7 pt-7 pb-3 bg-white rounded-md mb-6">
                  <div class="flex justify-between items-center">
                  <span class="text-xl md:text-2xl mb-2 font-semibold flex items-center">International Payments
                    <tooltip :tooltipText="' By enabling this option you can accept payment from different countries.'">
                      <QuestionMarkCircleIcon class="w-5 h-5  md:ml-2"/>
                    </tooltip>
                  </span>
                      <Switch v-model="enabledShopmata" :class="[enabledShopmata ? 'bg-indigo-600' : 'bg-gray-500', 'relative inline-flex flex-shrink-0 h-6 w-24 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200']">
                        <span class="sr-only">Use setting</span>
                        <span :class="[enabledShopmata ? 'translate-x-20' : 'translate-x-0', 'pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']">
                          <span :class="[enabledShopmata? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200', 'absolute inset-0 h-full w-full flex items-center justify-start transition-opacity text-white ml-6']" aria-hidden="true">
                            Disabled
                          </span>
                          <span :class="[enabledShopmata ? 'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100', 'absolute inset-0 h-full w-full flex items-center justify-end transition-opacity text-white -ml-6']" aria-hidden="true">
                            Enabled
                          </span>
                        </span>
                      </Switch>
                  </div>
                 
                 <div class="flex flex-col justify-center" v-if="enabledShopmata">
                    <p class="text-gray-400">View and manage the payment methods in your account. Based on your country, accept payments from customers into your preferred bank account.<a class="text-indigo-500 cursor-pointer" href="/settings/international-payment">Learn More </a></p>
                    <div class="flex flex-col items-center">
                      <p class="text-gray-400 mt-8">No bank details added yet </p>
                      <button class="text-white bg-indigo-700 rounded-md px-4 py-3 my-5 w-48" @click="this.popModal=true" >Add Accounts Details</button>

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
import axios from "axios";
import Tooltip from "../../../Components/Tooltip/Components/Tooltip.vue";

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot, Switch } from '@headlessui/vue'
import { ChevronLeftIcon,ChevronRightIcon } from '@heroicons/vue/solid'
import {QuestionMarkCircleIcon,ChevronDownIcon,ChevronUpIcon,HomeIcon} from '@heroicons/vue/outline'
import PaymentModal from './Components/PaymentModal.vue'

const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Payments', href: '/settings/payments', current: true },
]

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}
export default {
  props: ["payment_gateways", 'gateways','countries','store'],
  components: {
    Nav,
    AppLayout,
    Dialog, DialogOverlay, 
    TransitionChild, 
    TransitionRoot, 
    QuestionMarkCircleIcon,
    ChevronLeftIcon, 
    ChevronDownIcon,
    ChevronUpIcon,
    ChevronRightIcon, 
    HomeIcon,
    Switch,
    PaymentModal,
    Tooltip
  },
  
  data() {
    return {
      gate : true,
      payment_method_added: true,
      popModal : false,
    }
  },
  methods:{
        submit() {
            this.$modal.show('success-modal');
            // console.log(this.selectedProviders.manual);
        },
        getGateway(gateway_id) {
            const gateway = this.gateways.filter(data => data.id == gateway_id);
            return gateway[0];
        },
        async remove(id) {
            this.loading = true;
            try {
                const res = await axios.delete(`/settings/payments/${id}`);
                console.log("res",res);
                this.loading = false;
            } catch (error) {
                console.log(error);
                // const { notification } = error.response.data;
                // this.notification = notification;
                this.loading = false;
            }
            // console.log(this.selectedProviders.manual);
        },
        country(){
          //console.log(this.countries)
          for (let index = 0; index < this.countries.length; index++) {
            const element = this.countries[index];
            if (element.id ==this.store.country_id) {
              return element.name
            }
            
          }
          
        }
  },
  setup() {
    const open = ref(false)
    const enabledPayment = ref(false)
    const enabledShopmata = ref(true)
    return {
      statusStyles,
      pages,
      enabledPayment,
      enabledShopmata,
      PaymentModal
    }
  },

}
</script>

