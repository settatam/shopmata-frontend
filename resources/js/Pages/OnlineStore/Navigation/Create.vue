<template>
    <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
          <nav aria-label="Breadcrumb" class="bg-white border-b border-blue-gray-200 xl:hidden">
            <div class="max-w-3xl mx-auto py-3 px-4 flex items-start sm:px-6 lg:px-8">
              <inertia-link href="#" class="-ml-1 inline-flex items-center space-x-3 text-sm font-medium text-gray-900">
                <ChevronLeftIcon class="h-5 w-5 text-blue-gray-400" aria-hidden="true" />
                <span class="font-semibold text-2xl">Settings</span>
              </inertia-link>
            </div>
          </nav>

          <div class="flex-1 flex xl:overflow-hidden">
            <!-- Secondary sidebar -->
            <div class="hidden flex-shrink-0 w-96 bg-white border-r border-blue-gray-200 xl:flex xl:flex-col mt-5">
              <h1> Navigation Menu</h1>
              <p> Place to create a menu is here </p>
            </div>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-8.5/10 ml-7 mt-5">
                <div class="p-8 bg-white">
                  <h1 class="text-2xl mb-2 font-semibold">General information</h1>
                  <h2 class="text-lg font-semibold mb-9">Store Details</h2>
                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Menu Title
                    </label>
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="menu.name" required/>
                  </div>

                  <div class=" required w-full mb-4">
                    <label class="block text-gray-600 font-semibold mb-2 bg-transparent">
                      Handle
                    </label>
                    <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="" v-model="menu.handle" required/>
                  </div>
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
import { Inertia } from '@inertiajs/inertia'


import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon } from '@heroicons/vue/solid';

const statusStyles = {
  success: 'bg-green-100 text-green-800',
  processing: 'bg-yellow-100 text-yellow-800',
  failed: 'bg-gray-100 text-gray-800',
}
export default {
   props: {

  },
  
  components: {
    AppLayout,
    Dialog, DialogOverlay, TransitionChild, TransitionRoot
  },
  
  setup(props) {
    const open = ref(false)
    const menu = {
      name: '',
      handle: ''
    }

    function submit() {
      Inertia.post('/online-store/navigation', menu);
    }

    return {
      submit,
      menu
    }
  },

}
</script>

