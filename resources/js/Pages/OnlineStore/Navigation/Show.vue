<template>
    <app-layout>
     <!-- Breadcrumb -->
       <div class="flex-shrink-0 px-8 py-4 flex items-center">
          <p class="text-2xl font-semibold text-blue-gray-900">Online Store</p>
       </div>
        <nav class="flex px-8" aria-label="Breadcrumb">
          <ol role="list" class="flex items-center space-x-4">
            <li>
              <div>
                <a href="/dashboard" class="text-gray-400 hover:text-gray-500">
                  <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true" />
                  <span class="sr-only">Online Store</span>
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

        <div class="flex justify-between items-center mx-8 mt-8">
          <a href="/online-store/navigation/" class="hover:text-gray-700">
            <div class="flex items-center">
                <ArrowLeftIcon class="flex-shrink-0 h-5 w-5 text-gray-800" aria-hidden="true" />
                <h1 class="ml-4 text-xl font-extrabold text-gray-800">{{ menu.name }}</h1>
            </div>
          </a>
          <div class="">
            <button class="text-white bg-indigo-700 rounded-sm px-5 py-2" @click="addMenu">Add Menu Item</button>
              <add-menu-modal v-if="popModal" @close="this.popModal=false" :login="login" :title="title" :buttonMsg="buttonMsg" />
          </div>
        </div>

          <div class="flex-1 flex xl:overflow-hidden">
            <!-- Main content -->
            <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-3/4 ml-7 mt-5">
                <div class="p-8 bg-white">
                  <h2 class="text-lg font-semibold mb-9">Menu Details</h2>
                  <div class="w-full mb-4" v-if="menu.items.length">
                    <inertia-link href="/online-store/navigation/create">Create Another Menu List</inertia-link>
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <ul role="list" class="divide-y divide-gray-200">
                          <li v-for="m in menu.items" :key="m.id">
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
    </app-layout>
</template>

<script>

import { ref, reactive } from 'vue'
import AppLayout from '../../../Layouts/AppLayout.vue'

import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronRightIcon, ArrowLeftIcon } from '@heroicons/vue/solid';
import { HomeIcon } from '@heroicons/vue/outline';
import { Inertia } from '@inertiajs/inertia'

const pages = [
  { name: 'Online Store', href: '/online-store', current: false },
  { name: 'Navigation', href: '/online-store/navigation', current: false },
];

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
    Dialog, 
    DialogOverlay, 
    TransitionChild, 
    TransitionRoot, 
    ArrowLeftIcon,
    ChevronRightIcon,
    HomeIcon
  },
  
  setup(props) {
    const open = ref(false)
    const list = {
      name: '',
      link: ''
    }
    const m = props.menu;

    pages.push(
      { name: m.name, href: (`/online-store/navigation/${m.name}`), current: true },
    )

    function submit() {
      Inertia.post(`/online-store/navigation/${m.id}`, list);
    }

    return {
      pages,
      statusStyles,
      list,
      submit
    }
  },

}
</script>

