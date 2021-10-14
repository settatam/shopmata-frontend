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
                      <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                        Products
                      </h1>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                <inertia-link href="products/create" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                  Create New Product
                </inertia-link>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-8">
          <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl leading-6 font-medium text-gray-900">All Products</h2>
          </div>
          <!-- Activity table (small breakpoint and up) -->
          <div class="hidden sm:block">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
              <search v-bind:suggestions="suggestions"></search>
              <div class="flex flex-col mt-2">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="w-1/2 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-5" />
                          Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Role
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="product in products.data" :key="product.id" class="bg-white">
                        <td class="max-w-0 w-1/2 px-6 py-4 items-center whitespace-nowrap text-gray-900">
                          <div class="flex items-center">
                            <div class="flex h-5 mr-5">
                                <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                            </div>
                            <div class="flex-shrink-0 h-12 w-12 mr-5">
                              <img class="h-12 w-12 rounded-full" :src="product.image" alt="" />
                            </div>
                            <inertia-link href="#" class="group inline-flex space-x-2 truncate">
                              <p class="text-gray-800 truncate group-hover:text-gray-900 break-normal">
                                {{ product.title }}
                              </p>
                            </inertia-link>
                          </div>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          <span class="text-gray-900 font-medium">{{ product.amount }} </span>
                          {{ product.currency }}
                        </td>
                        <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                          <span :class="[statusStyles[product.status], 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize']">
                            {{ product.status }}
                          </span>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                          <time :datetime="product.datetime">{{ product.date }}</time>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500"> NOthing  </td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- Pagination -->
                  <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" aria-label="Pagination">
                    <div class="hidden sm:block">
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
                        <span class="font-medium">20</span>
                        {{ ' ' }}
                        results
                      </p>
                    </div>
                    <div class="flex-1 flex justify-between sm:justify-end">
                      <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                      </a>
                      <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                      </a>
                    </div>
                  </nav>
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

import {
  ScaleIcon,
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
  components: {AppLayout, ScaleIcon, Search},
  data() {
    return {
      notification: null,
      suggestions: [],
      dashboard: {
        highRiskOrder: 0, 
        ordersToFulfill: 0,
        paymentToCapture: 0, 
        percentage: 0,
        todaySales: 0, 
        totalSales: 0,
        graphData: {
          months: [],
          sales: []
        }
      }
    }
  },
  setup() {
    const open = ref(false)
    return {
      transactions,
      statusStyles,
      cards
    }
  },
  async mounted() {
  
  },

}
</script>

