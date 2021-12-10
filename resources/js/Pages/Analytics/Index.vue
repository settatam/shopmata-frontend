<template>
  <app-layout>
      <div class="flex-1 flex flex-col overflow-y-auto xl:overflow-hidden">
          <!-- Breadcrumb -->
          <div class="flex-shrink-0 mb-3 px-6 flex items-center">
              <div>
                <p class="text-2xl font-semibold text-gray-900">Analytics Overview</p>
                <p class="text-gray-400">Here is what is happening on your store today.</p>
              </div>
            </div>
            <nav class="flex px-6" aria-label="Breadcrumb">
              <ol role="list" class="flex items-center space-x-4">
                <li>
                  <div>
                    <inertia-link href="/dashboard">
                      <HomeIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
                      <span class="sr-only">Analytics</span>
                    </inertia-link>
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

          
          </div>
  </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
import Nav from '../../Layouts/Nav.vue'
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon, ChevronRightIcon  } from '@heroicons/vue/solid';
import {HomeIcon} from '@heroicons/vue/outline'

const pages = [
  { name: 'Analytics', href: '/analytics', current: true },
]

export default {
    components:{
        Nav,
        AppLayout, 
        Dialog, 
        DialogOverlay, 
        TransitionChild, 
        TransitionRoot,
        ChevronLeftIcon, 
        ChevronRightIcon,
        HomeIcon,
    },
    setup(){

        return{
            pages
        }
    }
}
</script>

<style>
</style>