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
                <form class="mt-6 space-y-8 divide-y divide-y-blue-gray-200">
                  <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-6 sm:gap-x-6">
                    <div class="sm:col-span-6">
                      <h2 class="text-xl font-medium text-blue-gray-900">Profile</h2>
                      <p class="mt-1 text-sm text-blue-gray-500">This information will be displayed publicly so be careful what you share.</p>
                    </div>

                    <div class="sm:col-span-3">
                      <label for="first-name" class="block text-sm font-medium text-blue-gray-900">
                        First name
                      </label>
                      <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="mt-1 block w-full border-blue-gray-300 rounded-md shadow-sm text-blue-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div class="sm:col-span-3">
                      <label for="last-name" class="block text-sm font-medium text-blue-gray-900">
                        Last name
                      </label>
                      <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="mt-1 block w-full border-blue-gray-300 rounded-md shadow-sm text-blue-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div class="sm:col-span-6">
                      <label for="username" class="block text-sm font-medium text-blue-gray-900">
                        Username
                      </label>
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-blue-gray-300 bg-blue-gray-50 text-blue-gray-500 sm:text-sm">
                          workcation.com/
                        </span>
                        <input type="text" name="username" id="username" autocomplete="username" value="lisamarie" class="flex-1 block w-full min-w-0 border-blue-gray-300 rounded-none rounded-r-md text-blue-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500" />
                      </div>
                    </div>

                    <div class="sm:col-span-6">
                      <label for="photo" class="block text-sm font-medium text-blue-gray-900">
                        Photo
                      </label>
                      <div class="mt-1 flex items-center">
                        <img class="inline-block h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2.5&w=256&h=256&q=80" alt="" />
                        <div class="ml-4 flex">
                          <div class="relative bg-white py-2 px-3 border border-blue-gray-300 rounded-md shadow-sm flex items-center cursor-pointer hover:bg-blue-gray-50 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-blue-gray-50 focus-within:ring-blue-500">
                            <label for="user-photo" class="relative text-sm font-medium text-blue-gray-900 pointer-events-none">
                              <span>Change</span>
                              <span class="sr-only"> user photo</span>
                            </label>
                            <input id="user-photo" name="user-photo" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md" />
                          </div>
                          <button type="button" class="ml-3 bg-transparent py-2 px-3 border border-transparent rounded-md text-sm font-medium text-blue-gray-900 hover:text-blue-gray-700 focus:outline-none focus:border-blue-gray-300 focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-gray-50 focus:ring-blue-500">
                            Remove
                          </button>
                        </div>
                      </div>
                    </div>

                    <div class="sm:col-span-6">
                      <label for="description" class="block text-sm font-medium text-blue-gray-900">
                        Description
                      </label>
                      <div class="mt-1">
                        <textarea id="description" name="description" rows="4" class="block w-full border border-blue-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500" />
                      </div>
                      <p class="mt-3 text-sm text-blue-gray-500">Brief description for your profile. URLs are hyperlinked.</p>
                    </div>

                    <div class="sm:col-span-6">
                      <label for="url" class="block text-sm font-medium text-blue-gray-900">
                        URL
                      </label>
                      <input type="text" name="url" id="url" class="mt-1 block w-full border-blue-gray-300 rounded-md shadow-sm text-blue-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                  </div>

                  <div class="pt-8 grid grid-cols-1 gap-y-6 sm:grid-cols-6 sm:gap-x-6">
                    <div class="sm:col-span-6">
                      <h2 class="text-xl font-medium text-blue-gray-900">Personal Information</h2>
                      <p class="mt-1 text-sm text-blue-gray-500">This information will be displayed publicly so be careful what you share.</p>
                    </div>

                    <div class="sm:col-span-3">
                      <label for="email-address" class="block text-sm font-medium text-blue-gray-900">
                        Email address
                      </label>
                      <input type="text" name="email-address" id="email-address" autocomplete="email" class="mt-1 block w-full border-blue-gray-300 rounded-md shadow-sm text-blue-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div class="sm:col-span-3">
                      <label for="phone-number" class="block text-sm font-medium text-blue-gray-900">
                        Phone number
                      </label>
                      <input type="text" name="phone-number" id="phone-number" autocomplete="tel" class="mt-1 block w-full border-blue-gray-300 rounded-md shadow-sm text-blue-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div class="sm:col-span-3">
                      <label for="country" class="block text-sm font-medium text-blue-gray-900">
                        Country
                      </label>
                      <input type="text" name="country" id="country" autocomplete="country" class="mt-1 block w-full border-blue-gray-300 rounded-md shadow-sm text-blue-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div class="sm:col-span-3">
                      <label for="language" class="block text-sm font-medium text-blue-gray-900">
                        Language
                      </label>
                      <input type="text" name="language" id="language" class="mt-1 block w-full border-blue-gray-300 rounded-md shadow-sm text-blue-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <p class="text-sm text-blue-gray-500 sm:col-span-6">This account was created on <time datetime="2017-01-05T20:35:40">January 5, 2017, 8:35:40 PM</time>.</p>
                  </div>

                  <div class="pt-8 flex justify-end">
                    <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-blue-gray-900 hover:bg-blue-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                      Cancel
                    </button>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Save</button>
                  </div>
                </form>
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

