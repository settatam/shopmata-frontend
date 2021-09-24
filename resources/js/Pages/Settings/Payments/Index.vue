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

          <div class="flex-1 flex xl:overflow-hidden mt-5">
            <!-- Secondary sidebar -->
            <Nav page="Payments"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="ww-auto  lg:ml-7 lg:mr-2">
                <div class="p-8 bg-white rounded-md mb-6">
                  <div class="flex justify-between">
                  <h1 class="text-2xl mb-2 font-semibold">Payments</h1>
                  <div class="flex">
                    <p class="text-gray-400 mr-4">Your business is located in </p>
                    <!-- Dynamically Change Location -->
                    <p class="mr-2">Nigeria</p>
                    <QuestionMarkCircleIcon class="text-indigo-700 w-5 h-5"/>
                  </div>

                  </div>
                  <p class="text-gray-400">
                    View and manage the payment methods in your account. Based on your country, these options have been selected. You can always add more, or change providers later.
                  </p>
                </div>
                <div class="px-7 pt-7 pb-3 bg-white rounded-md mb-6">
                  <div class="flex justify-between">
                  <span class="text-2xl mb-2 font-semibold flex items-center">Pay on Delivery <QuestionMarkCircleIcon class="w-5 h-5 ml-2"/></span>
                      <Switch v-model="enabledPayment" :class="[enabledPayment ? 'bg-indigo-600' : 'bg-gray-500', 'relative inline-flex flex-shrink-0 h-6 w-25 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']">
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
                <div class="px-7 pt-7 pb-3 bg-white rounded-md mb-6">
                  <div class="flex justify-between">
                  <span class="text-2xl mb-2 font-semibold flex items-center">Shopmata Payment<QuestionMarkCircleIcon class="w-5 h-5 ml-2"/></span>
                      <Switch v-model="enabledShopmata" :class="[enabledShopmata ? 'bg-indigo-600' : 'bg-gray-500', 'relative inline-flex flex-shrink-0 h-6 w-25 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']">
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
                 <div v-if="enabledShopmata" class="mt-6  bg-gray-50 py-4 px-7 rounded">
                   <p class="font-bold text-lg">Bank Account Details</p>
                   <p class="text-gray-500 mb-5">Enter your bank account details to receive payments.</p>

                   <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Bank Name
                    </label>
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Select bank name" v-model="payment.bank_name" required/>
                  </div>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Account Name
                    </label>
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Enter your account name" v-model="payment.acct_name" required/>
                  </div>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Account Number
                    </label>
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Enter your account number" v-model="payment.acct_number" required/>
                  </div>
                 </div>
                 <div class="flex justify-between" v-if="enabledShopmata">
                    <div></div>
                    <button class="text-white bg-indigo-700 rounded-md px-8 py-3  my-5" @click="submit">Save Changes</button>
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

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot, Switch } from '@headlessui/vue'
import { ChevronLeftIcon,ChevronRightIcon,CogIcon } from '@heroicons/vue/solid'
import {QuestionMarkCircleIcon,ChevronDownIcon,ChevronUpIcon} from '@heroicons/vue/outline'

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
  props: ["payment_gateways", 'gateways'],
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
    CogIcon,
    Switch
  },
  
  data() {
    return {
      gate : true,
      payment_method_added: true,
      payment:{
        acct_name:'',
        acct_number:"",
        bank_name:""

      }
    
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
      enabledShopmata
    }
  },

}
</script>

