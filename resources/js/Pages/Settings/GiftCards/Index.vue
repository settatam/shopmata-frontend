<template>
    <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
          <nav aria-label="Breadcrumb" class="bg-white border-b border-blue-gray-200 xl:hidden">
            <div class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8">
              <inertia-link href="#" class="-ml-1 inline-flex items-center space-x-3 text-sm font-medium text-blue-gray-900">
                <ChevronLeftIcon class="h-5 w-5 text-blue-gray-400" aria-hidden="true" />
                <span>Settings</span>
              </inertia-link>
            </div>
          </nav>

          <div class="flex-1 flex xl:overflow-hidden">
            <!-- Secondary sidebar -->
            <Nav page="GiftCards"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-8.5/10 ml-7">
                <div class="p-8 bg-white">
                  <h1 class="text-2xl mb-2 font-semibold">Gift Cards</h1>
                    <h2 class="text-lg font-semibold">Auto-expiration</h2>
                    <p class="text-gray-400 text-sm mt-2 mb-5">Set your gift cards to expire a certain amount of time after they,ve been purchased.</p>
                    <div class="border border-gray-300 px-7 pt-7 pb-6">
                      <p class="ml-9 mb-2">Gift cards expires</p>
                      <p class="ml-9 mb-6">Gift cards never expires</p>
                      <div class="flex mb-6">
                        <input type="text" name="" v-model="gift.duration" placeholder="5" class="w-20 mr-2.5 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md">
                        <select name="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="5" v-model="gift.type" >
                          <option value="year" >Years after purchase</option>
                          <option value="month">Months after purchase</option>
                          <option value="day">Days after purchase</option>
                        </select>
                      </div>
                        <p class="text-gray-400">Countries have different laws for gift card expiry dates. Check the laws for your country before changing this date.</p>
                    </div>
                </div>
                    <button class="text-white bg-indigo-700 rounded-md px-8 py-3 float-right my-5" @click="submit" >Save Changes</button>
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
import { ChevronLeftIcon } from '@heroicons/vue/solid'

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
  
  components: {
    Nav,
    AppLayout,
    Dialog, DialogOverlay, TransitionChild, TransitionRoot
  },
  
  data() {
    return {
      gift:{
        duration:'1',
        type:'day'
      }
    }
  },
  methods:{
    submit(){
      
      try {
        axios.post('settings/gift-cards',this.gift)
      } catch (error) {
        console.log(error)
      }
    }
  },
  setup() {
    const open = ref(false)
    return {
      statusStyles,
    }
  },

}
</script>

