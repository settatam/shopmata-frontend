<template>
    <app-layout>
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

          <div class="flex-1 flex xl:overflow-hidden">
            <!-- Secondary sidebar -->
            <div class="hidden flex-shrink-0 w-84 bg-white border-r border-blue-gray-200 xl:flex xl:flex-col mt-5">
              <h1> Navigation Menu</h1>
              <p> Place to create a menu is here </p>
            </div>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class=" w-3/4 ml-7 mt-5">
                <div class="p-8 bg-white">
                  <h2 class="text-lg font-semibold mb-9">Menu Details</h2>
                  <div class="w-full mb-4" v-if="menu.list.length">
                    <inertia-link href="/online-store/navigation/create">Create Another Menu List</inertia-link>
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <ul role="list" class="divide-y divide-gray-200">
                          <li v-for="m in menu.list" :key="menu.id">
                            <inertia-link :href="'online-store/navigation/'+menu.id" class="block hover:bg-gray-50">
                              <div class="px-4 py-4 flex items-center sm:px-6">
                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                  <div class="truncate">
                                    <div class="flex flex-col text-sm">
                                      <p class="font-medium text-indigo-600 truncate">{{ m.name }}</p>
                                      <p class="font-normal text-gray-500">{{ m.link }}</p>
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
                      </div>

                  </div>
                  <div class="w-full mb-4" v-else>
                    <p> <span>You do not have any menu created.</span> <inertia-link href="/online-store/navigation/create">Create Menu List</inertia-link>
                    </p>
                  </div>

                </div>

                <div class="p-8 bg-white w-full">
                  <h3> Create New menu list</h3>
                          <div class=" required w-full mb-4">
                            <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                              Menu Title
                            </label>
                            <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="list.name" required/>
                          </div>

                          <div class=" required w-full mb-4">
                            <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                              Link
                            </label>
                            <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="list.handle" required/>
                          </div>
                          <p> **We should have a target</p>
                          <p> **All pavailable pages should drop down</p>
                      </div>
                <button class="text-white bg-indigo-700 rounded-md px-8 py-3 float-right my-5" @click="submit">Save Menu</button>
              </div>
            </div>
          </div>
        </div>
    </app-layout>
</template>

<script>

import { ref, reactive } from 'vue'
import AppLayout from '../../../Layouts/AppLayout.vue'
import Search from '../../Search.vue'

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronRightIcon } from '@heroicons/vue/solid';
import { Inertia } from '@inertiajs/inertia'

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}
export default {
   props: {
    menu: Object
  },
  
  components: {
    AppLayout,
    Dialog, DialogOverlay, TransitionChild, TransitionRoot, ChevronRightIcon
  },
  
  setup(props) {
    const open = ref(false)
    const list = {
      name: '',
      link: ''
    }
    const m = props.menu

    function submit() {
      Inertia.post(`/online-store/navigation/${m.id}`, list);
    }

    return {
      statusStyles,
      list,
      submit
    }
  },

}
</script>

