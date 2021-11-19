<template>
    <app-layout>
        <!-- Page header -->
        <div class="">
          <div class="px-4 sm:px-6 lg:mx-auto lg:px-8">
            <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
              <div class="flex-1 min-w-0">
                <!-- Profile -->
                <div class="flex items-center">
                  <div>
                    <div class="flex items-center">
                      <h1 class="ml-3 text-2xl font-semibold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                        All Products
                      </h1>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-6 flex  md:mt-0 md:ml-1">
                <div class="border p-3 cursor-pointer rounded border-red-500 mr-1">
                  <trash-icon class="w-4 h-4  text-red-500"/>
                </div>
                <inertia-link href="/products/create" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm  rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                 <plus-icon class="w-5 h-5 text-white mr-2"/> Create New Product
                </inertia-link>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-8">
          
          <!-- Activity table (small breakpoint and up) -->
          <div class="hidden sm:block">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mt-3 sm:mt-4">
                  <!-- <div class="sm:hidden">
                    <label for="current-tab" class="sr-only">Select a tab</label>
                    <select id="current-tab" name="current-tab" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                      <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
                    </select>
                  </div> -->
                 <!--  <div class="hidden sm:block mb-5 ">
                    <nav class="-mb-px -pb-px flex space-x-8 relative ">
                      <a v-for="tab in tabs" :key="tab.name" :href="tab.href" :class="[tab.current ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'whitespace-nowrap pb-1 font-normal px-1 border-b-2']" @click="currentTab(tab.id)">
                        {{ tab.name }}
                      </a>
                    </nav>
                    <div class="border-b-2 div-mb border-gray-200 w-full"></div>
                  </div> -->
                  <div class="flex mb-5 justify-between">
                    <div class="">
                      <label for="search-field" class="">Search</label>
                      <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none" aria-hidden="true">
                          <SearchIcon class="h-5 w-5 ml-5" aria-hidden="true" />
                        </div>
                        <input id="search-field" name="search-field" class="rounded text-gray-500 search-field pl-12 pr-2 bg-transparent border border-gray-200 placeholder-gray-500" placeholder="Search by name, email....." type="search" />
                      </div>
                    </div>
                    <div class="flex flex-col">
                      <label for="brand">Brand</label>
                      <select name="brand" id="" class="rounded text-gray-500 w-48 bg-transparent border border-gray-200 ">
                        <option value="1">All</option>
                      </select>
                    </div>
                    <div class="flex flex-col">
                      <label for="Status">Category</label>
                      <select name="Status" id="" class="rounded text-gray-500 w-48 bg-transparent border border-gray-200">
                        <option value="1">All</option>
                      </select>
                    </div>
                    <div class="flex flex-col">
                      <label for="Tag">Status</label>
                      <select name="Tag" id="" class="rounded text-gray-500 w-48 bg-transparent border border-gray-200">
                        <option value="1">All</option>
                      </select>
                    </div>
                  </div>
                </div>
              <div class="flex flex-col mt-2">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="w-2/5 max-w-0 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-5" />
                          PRODUCTS
                        </th>
                        <th scope="col" class="w-2/10 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          STOCK LEVEL
                        </th>
                        <th scope="col" class="w-1/10 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          BRAND
                        </th>
                        <th scope="col" class=" w-1/10 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          CATEGORY
                        </th>
                        <th scope="col" class="w-1/10 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          PRICE
                        </th>
                        <th scope="col" class="w-1/10 px-6 py-3 text-left text-xs font-normal text-gray-500 uppercase tracking-wider">
                          Status
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="product in products.data" :key="product.id" class="bg-white">
                        <td class="w-2/5 max-w-0 px-6 py-4 items-center text-gray-900">
                          <div class="flex items-center">
                            <div class="flex h-5 mr-5">
                                <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                            </div>
                            <div class="flex-shrink-0 h-12 w-12 mr-5">
                              <img class="h-12 w-12 rounded-full" :src="product.images[0].url" alt='{{product.title}}' />
                            </div>
                            <inertia-link href="#" class="group inline-flex space-x-2 truncate">
                              <p class="text-gray-800 truncate group-hover:text-gray-900 break-normal">
                                {{ product.title }}
                              </p>
                            </inertia-link>
                          </div>
                        </td>
                        <td class="w-2/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          <span class="text-gray-900 font-normal">{{ product.amount }} </span>
                          {{ product.currency }}
                        </td>
                        <td class="w-1/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          <span class="text-gray-900 font-normal">{{ product.amount }} </span>
                          {{ product.currency }}
                        </td>
                        <td class=" w-1/10px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          <span class="text-gray-900 font-normal">{{ product.amount }} </span>
                          {{ product.currency }}
                        </td>
                        <td class="w-1/10 px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                          <span :class="[statusStyles[product.status], 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-normal capitalize']">
                            {{product.status}}
                          </span>
                        </td>
                        <td class="w-1/10 px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          <time :datetime="product.datetime">{{ product.date }}</time>
                        </td>
                        <td>
                          <pencil-icon class="w-5 h-5 text-indigo-700"/>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- Pagination -->
                </div>
              </div>
                 <div class="py-3 flex items-center justify-between border-t border-gray-200">
                    <div class="flex-1 flex justify-between sm:hidden">
                      <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                      </a>
                      <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                      </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                      <div>
                        <p class="text-sm text-gray-700">
                          Showing
                          {{ ' ' }}
                          <span class="font-medium">1</span>
                          {{ ' ' }}
                          to
                          {{ ' ' }}
                          <span class="font-medium">10</span>
                          {{ ' ' }}
                          of
                          {{ ' ' }}
                          <span class="font-medium">{{products.data.length}}</span>
                          {{ ' ' }}
                          results
                        </p>
                      </div>
                      <div>
                        <nav class="relative z-0 inline-flex  -space-x-px" aria-label="Pagination">
                          <a href="#" class="relative inline-flex items-center px-2  text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                          </a>
                          <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                          <a href="#" aria-current="page" class="z-10 bg-indigo-500 rounded text-white relative inline-flex items-center px-2">
                            1
                          </a>
                          <a href="#" class="  text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2">
                            2
                          </a>
                          <a href="#" class="  text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-2">
                            3
                          </a>
                          <span class="relative inline-flex items-center px-2   text-gray-700">
                            ...
                          </span>
                          <a href="#" class="  text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2">
                            10
                          </a>
                          <a href="#" class="relative inline-flex items-center px-2  rounded-r-md font-medium text-gray-700 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                          </a>
                        </nav>
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
import AppLayout from '../../Layouts/AppLayout.vue'
import Search from '../Search.vue'
import axios from "axios"
import { Inertia } from '@inertiajs/inertia'
import { ChevronLeftIcon, ChevronRightIcon, PencilIcon, SearchIcon } from '@heroicons/vue/solid'
import {
  ScaleIcon,PlusIcon, TrashIcon
} from '@heroicons/vue/outline'

const transactions = [
  {
    id: 1,
    name: 'Payment to Molly Sanders',
    href: '#',
    amount: '$20,000',
    currency: 'USD',
    status: 'success',
    date: 'July 11, 2020',
    datetime: '2020-07-11',
  },
  // More transactions...
]


const cards = [
  { name: 'Account balance', href: '#', icon: ScaleIcon, amount: '$30,659.45' },
  // More items...
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
  components: {AppLayout, ScaleIcon, SearchIcon, PlusIcon, TrashIcon,ChevronLeftIcon,ChevronRightIcon,PencilIcon},
  
  setup() {
    
    const open = ref(false)
    const suggestions = ref([]);
    const selection = ref('');
    /* const tabs = ref([
      { name: 'All', href: '#', current: true, id:1 },
      { name: 'Active', href: '#', current: false, id:2 },
      { name: 'Draft', href: '#', current: false, id:3 },
      { name: 'Archived', href: '#', current: false, id:4 }
    ]) */
    
    function getAutoCompleteData(term){
      selection.value = term
      if(term.length > 2) {
          axios.get(`/products/get-data?term=${term}`)
            .then(res=>{
                suggestions.value = res.data
            }) 
          }
    }

    function updateCurrentList(index){
      const suggestion = suggestions.value.filter(list => list.id == index)
      selection.value = suggestion[0].title;
      suggestions.value= [];
      Inertia.visit(`products/${suggestion[0].id}`)
    }

    /* function currentTab(id){
        for (const tab of tabs.value) {
         if (tab.id == id) {
           tab.current =true
           //console.log(tab.id, id)
         }
         else{
           tab.current = false
         }
       }
    } */
    
    return {
      transactions,
      statusStyles,
      cards,
      getAutoCompleteData,
      suggestions,
      selection,
      updateCurrentList,
    }
  },
  async mounted() {
  
  },

}
</script>
<style scoped>
.div-mb {
  margin-top: -2px;
}
.search-field {
  width: 468px;
}
</style>

