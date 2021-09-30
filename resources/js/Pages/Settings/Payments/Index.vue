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
            <Nav page="Payments"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-9.5/10 ml-7 mt-5">
                <div class="p-8 bg-white rounded-md mb-6">
                  <div class="flex justify-between">
                  <h1 class="text-2xl mb-2 font-semibold">Payments</h1>
                  <div class="flex">
                    <p class="text-gray-400">Your business is located in</p>
                    <!-- Dynamically Change Location -->
                    <p>Nigeria</p>
                    <QuestionMarkCircleIcon class="text-indigo-700 w-5 h-5"/>
                  </div>

                  </div>
                  <p class="text-gray-400">
                    View and manage the payment methods in your account. Based on your country, these options have been selected. You can always add more, or change providers later.
                  </p>
                </div>
                <div class="p-8 bg-white rounded-md">
                  <div class="flex justify-between">
                    <h1 class="text-2xl mb-2 font-semibold">Payment Gateway</h1>
                    <ChevronUpIcon class="w-5 h-5" v-if="gate"/>
                    <ChevronDownIcon class="w-5 h-5" v-else/>
                  </div>
                     <div v-for="provider in providers" :key="provider.id">
                        <div class="flex justify-between" >
                          <input type="radio" name="" class="">
                          <h2 class="w-8/10 font-semibold">{{provider.name}}</h2>
                         
                          <img src='../../../../assets/paystack-logo.svg' alt="icon">
                        </div>
                        <p class="text-gray-400">{{provider.description}}</p>
                    </div> 
                    <!-- 
                  <div class="bg-white my-6 py-8 px-4 md:px-11" v-for="(gateway, index) in payment_gateways" :key="index">
                      <div class="flex justify-between items-center">
                          <div class="md:flex items-center">
                              <img class="w-10" :src="getGateway(gateway.payment_gateway_id).logo" alt="paystack-logo" />
                              <div class="md:ml-8 md:mt-0 mt-2">
                                  <p class="text-xl capitalize">{{getGateway(gateway.payment_gateway_id).name}}</p>
                                  <p class="text-gray-400">{{getGateway(gateway.payment_gateway_id).name}}</p>
                              </div>
                          </div>
                          <t-button class="focus:outline-none" @click="remove(gateway.id)">
                              <img src="../.././../../assets/trash.svg" alt="trash-icon" />
                          </t-button>
                      </div>
                  </div>
                 -->
                </div>
                <button class="text-white bg-indigo-700 rounded-md px-8 py-3 float-right my-5" @click="submit">Save Changes</button>
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
    Dialog, DialogOverlay, TransitionChild, TransitionRoot, QuestionMarkCircleIcon,ChevronLeftIcon, ChevronDownIcon,ChevronUpIcon, ChevronRightIcon, CogIcon
  },
  
  data() {
    return {
      gate : true,
      payment_method_added: true,
      providers: [
                {
                    id: 1,
                    name: 'Paystack',
                    description: 'Paystack helps businesses in Africa get paid by anyone, anywhere in the world.',
                    icon: '../../../../assets/paystack-logo.svg'
                },
                {
                    id: 2,
                    name: 'Paypal',
                    description: 'Accept payments from customers with a paypal account',
                    icon: '../../../../assets/paypal-logo.svg'
                },
                {
                    id: 3,
                    name: 'Manual',
                    description: 'Accept cash, or other custom forms of payment.',
                    icon: '../../../../assets/manual-payment-icon.svg'
                }
            ],
            selectedProviders: {
                paystack: true,
                paypal:false,
                manual: false,
                stripe: false
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
    return {
      statusStyles,
      pages
    }
  },

}
</script>

