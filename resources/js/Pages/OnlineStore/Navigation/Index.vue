<template>
    <app-layout>
       <div class="px-4 sm:px-6 lg:mx-auto lg:px-8">
          <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
            <div class="flex-1 min-w-0">
              <!-- Profile -->
                <div>
                  <div class="flex items-center">
                    <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                      Online Store
                    </h1>
                  </div>
              </div>
            </div>
          </div>
       </div>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
          <nav aria-label="Breadcrumb" class="bg-white border-b border-blue-gray-200 xl:hidden">
            <div class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8">
              <inertia-link href="#" class="-ml-1 inline-flex items-center space-x-3 text-sm font-medium text-blue-gray-900">
                <ChevronLeftIcon class="h-5 w-5 text-blue-gray-400" aria-hidden="true" />
                <span class="font-semibold text-2xl">Settings</span>
              </inertia-link>
            </div>
          </nav>

          <!-- <div class="flex-1 flex xl:overflow-hidden"> -->
            <!-- Secondary sidebar -->
            <!-- <div class="hidden ml-5 flex-shrink-0 w-96 bg-white border-r border-blue-gray-200 xl:flex xl:flex-col mt-5">
              <div class="pl-7 pt-7 pb-12 space-y-4">
                <div>
                  <h1 class=" font-semibold">My Themes</h1>
                  <p class=" text-gray-400">Lorem ipsum dolor sit amet</p>
                </div>
                <div>
                  <h1 class=" font-semibold">Marketing</h1>
                  <p class=" text-gray-400">Lorem ipsum dolor sit amet</p>
                </div>
                <div>
                  <h1 class=" font-semibold">Logo</h1>
                  <p class=" text-gray-400">Lorem ipsum dolor sit amet</p>
                </div>
                <div>
                  <h1 class=" font-semibold">Blog Posts</h1>
                  <p class=" text-gray-400">Lorem ipsum dolor sit amet</p>
                </div>
                <div>
                  <h1 class=" font-semibold">Pages</h1>
                  <p class=" text-gray-400">Lorem ipsum dolor sit amet</p>
                </div>
                <div>
                  <h1 class=" font-semibold">Navigation</h1>
                  <p class=" text-gray-400">Lorem ipsum dolor sit amet</p>
                </div>
                <div>
                  <h1 class=" font-semibold">Domains</h1>
                  <p class=" text-gray-400">Lorem ipsum dolor sit amet</p>
                </div>
                <div>
                  <h1 class=" font-semibold">Preferences</h1>
                  <p class=" text-gray-400">Lorem ipsum dolor sit amet</p>
                </div>
              </div> -->
            <!-- </div> -->
            <!-- Main content -->
            <div class="flex items-center justify-center flex-1 xl:overflow-y-auto">
              <div class="w-2/3 mt-5 bg-white card">
                <div class="p-8">
                  <div class="flex justify-between">
                    <h1 class="text-xl font-bold mb-4.5">Menu Lists</h1>
                    <div class="text-indigo-600">
                      <inertia-link href="/online-store/navigation/create" class="underline flex"><span class="pl-2 mt-1"><Plus-icon class="w-4 h-4" /></span>Add Menu</inertia-link>
                    </div>
                  </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                  <div class="w-full mt-6">
                    <div class="flex justify-between text-gray-500  mb-1.5">
                      <p class="w-1/2">Menu Title</p>
                      <p class="w-1/2">Menu Items</p>
                    </div>
                    <div class="border-b border-gray-300 -mx-8">
                    </div>
                  </div>
                  <div class="w-full mt-6" v-if="false">
                    
                    <!-- <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <ul role="list" class="divide-y divide-gray-200">
                          <li v-for="m in menu" :key="menu.id">
                            <inertia-link :href="'/online-store/navigation/'+m.id" class="block hover:bg-gray-50">
                              <div class="px-4 py-4 flex items-center sm:px-6">
                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                  <div class="truncate">
                                    <div class="flex text-sm">
                                      <p class="font-medium text-indigo-600 truncate">{{ m.name }}</p>
                                      <p class="ml-1 flex-shrink-0 font-normal text-gray-500">No menu items yet</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="ml-5 flex-shrink-0">
                                  <ChevronRightIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                </div>
                              </div>
                            </inertia-link>
                          </li>
                        </ul>
                      </div> -->

                  </div>
                  <div class="flex justify-center mt-14 mb-4" v-else>
                    <p class="text-gray-500"> <span>No menu created yet.</span> <inertia-link href="/online-store/navigation/create">Create Menu</inertia-link>
                    </p>
                  </div>
                <div class="flex justify-center">
                  <button class="text-white bg-indigo-700 rounded-md px-8 py-3" @click="submit">Add Menu</button>
                </div>

                </div>
              </div>
            </div>
          </div>
        <!-- </div> -->
    </app-layout>
</template>

<style>
 .card {
   min-height: 70vh;
 }
</style>

<script>

import { ref, reactive } from 'vue'
import AppLayout from '../../../Layouts/AppLayout.vue'
import SortableList from '../../../Components/SortableList.vue'
import SortableItem from '../../../Components/SortableItem.vue'
import Search from '../../Search.vue'

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronRightIcon } from '@heroicons/vue/solid';
import { PlusIcon } from '@heroicons/vue/solid';

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}
export default {
   props: {
    menu: Array
  },
  
  components: {
    AppLayout,
    Dialog, 
    DialogOverlay, 
    TransitionChild, 
    TransitionRoot, 
    ChevronRightIcon,
    SortableList,
    SortableItem
  },
  
  setup(props) {
    const open = ref(false)
    // const navMenu = props.menu;

    // function submit() {
    //   Inertia.put('/store', store_details);
    // }

    return {
      statusStyles,
      // navMenu
    }
  },

}
</script>

