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
            <Nav page="General"></Nav>
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
                <h1 class="text-3xl font-extrabold text-blue-gray-900">General</h1>

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
import Nav from './Nav';
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

