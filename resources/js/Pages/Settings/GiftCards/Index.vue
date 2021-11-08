<template>
    <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
        <div class="flex-shrink-0 mb-3 px-6 xflex items-center">
              <p class="text-2xl font-semibold text-blue-gray-900">Settings</p>
            </div>
            <nav class="flex px-6" aria-label="Breadcrumb">
              <ol role="list" class="flex items-center space-x-4">
                <li>
                  <div>
                    <a href="/dashboards" class="text-gray-400 hover:text-gray-500">
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
            <Nav page="GiftCards"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-full xl:w-9.5/10 xl:ml-7">
                <div class="p-4 md:p-8 bg-white">
                  <h1 class="text-2xl mb-2 font-semibold">Gift Cards</h1>
                    <h2 class="text-lg font-semibold">Auto-expiration</h2>
                    <p class="text-gray-400 text-sm mt-2 mb-5">Set your gift cards to expire a certain amount of time after they,ve been purchased.</p>
                    <div class="border border-gray-300 px-3 md:px-7 pt-7 pb-6">
                      <div class="flex flex-col ">
                        <p class="ml-4 md:ml-9 mb-2 my-auto"> <input  type="radio" name="" @click="gift.expire=0 " value=0 v-model="gift.expire" id="" class="cursor-pointer custom-form-radio mr-5">Gift cards expires</p>
                        <p class="ml-4 md:ml-9 mb-6 my-auto"> <input  type="radio" name=""  @click="gift.expire=1" value=1 v-model="gift.expire" id="" class="cursor-pointer custom-form-radio mr-5">Gift cards never expires</p>
                      </div>
                      <div class="flex mb-6">
                        <input type="text" name="" v-model="gift.period" placeholder="5" class="w-20 mr-2.5 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md">
                        <select name="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" v-model="gift.duration" >
                          <option value="years" >Years after purchase</option>
                          <option value="months">Months after purchase</option>
                          <option value="days">Days after purchase</option>
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
const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Gift Cards', href: '/settings/gift-cards', current: true },
]

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon,ChevronRightIcon} from '@heroicons/vue/solid'
import{HomeIcon} from '@heroicons/vue/outline'

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
    Dialog, DialogOverlay, TransitionChild, TransitionRoot,ChevronRightIcon,HomeIcon
  },
  
  data() {
    return {
      gift:{
        duration:'days',
        period:"",
        expire:1
      }
    }
  },
  methods:{
    submit(){
      
      try {
        axios.post('gift-cards',this.gift)
      } catch (error) {
        console.log(error)
      }
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

