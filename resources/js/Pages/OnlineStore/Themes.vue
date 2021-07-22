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

        </div>
    </app-layout>
</template>
<script>
import { ref } from 'vue'
import axios from "axios"
import AppLayout from '../../Layouts/AppLayout.vue'
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon } from '@heroicons/vue/solid'
export default {
  components: { 
        AppLayout,
        Dialog, 
        DialogOverlay, 
        TransitionChild, 
        TransitionRoot, 
        ChevronLeftIcon
    },
    setup() {
        
    },
}
</script>