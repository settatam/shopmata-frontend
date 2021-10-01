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
            <Nav page="Notifications"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-auto  lg:ml-7 lg:mr-2">
                  <div class="px-8 pb-8 pt-6  mb-6 bg-white">
                    <h1 class="text-xl font-bold">Email</h1>
                        <div class="w-auto">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Email subject
                            </label>
                            <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Order Confirmation"  required/>
                        </div>
                        <div class="w-auto">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Email body (HTML)
                            </label>
                            <textarea  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm  border-gray-300 h-96 rounded-md" placeholder="Order Confirmation"  required/>
                        </div>
                  </div>
              </div>
            </div>
            </div>
      </div>
  </app-layout>
</template>

<script>

import AppLayout from '../../../Layouts/AppLayout.vue'
import Nav from '../Nav'
import { ChevronLeftIcon, ChevronUpIcon,ChevronDownIcon,ChevronRightIcon,CogIcon  } from '@heroicons/vue/solid'

const pages = [
  { name: 'Settings', href: '/settings', current: false },
  { name: 'Notifications', href: '/settings/notifications', current: false },
  { name: 'Order Confirmation', href: '/settings/notifications/order-confirmation', current: true },
]

export default {
    components:{
        AppLayout,
        ChevronRightIcon,
        CogIcon,
        Nav
    },
    setup() {
    return {
      pages,
    }
  },
}
</script>

<style>
</style>